<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ProductWinMail;
use App\Models\Comment;
use App\Models\ProductBid;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Exception;
use App\Models\Product;
use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

use Illuminate\Database\Eloquent\ModelNotFoundException;
class ProductController extends Controller
{


    use HttpResponses;


    public function product_bids($product_id,$page=0){
        $per_page=10;
        $bids = ProductBid::where('product_id','=',$product_id)->orderBy('id','DESC');
        $page_count = ceil($bids->count() / $per_page);
        $bids = $bids->offset(($page*$per_page))->limit($per_page)->get();
      //  return $bids;
      //  return $page."::".$product_id.":".$page_count."::".$bids->count();
      return view('front.partials.product_bids',compact('bids','page_count','page','product_id'));
    }

public function comment_post(Request $request){
    if(Auth::id()){
        try{

            $msg = ($request['comment_id']>0) ? 'Yanıtınız':'Yorumunuz';
            $comment = new Comment();
            $comment->product_id = $request['product_id'];
            $comment->comment_id = $request['comment_id'];
            $comment->comment = $request['comment'];
            $comment->user_id = Auth::id();
                $comment->verified =0;
                $comment->save();


             return  $this->success([''], $msg.' için teşekkür ederiz',201);


         }catch (Exception $e){
            // return response()->json(['error' => $e->getMessage()], 500);
             return  $this->error([''], $e->getMessage() ,500);
         }
    }
}

public function product_make_comment($product_id,$comment_id=0){
    $comment = ($comment_id>0)? Comment::find($comment_id):null;
    $product= Product::find($product_id);
    return view('front.partials.make_comment',compact( 'product_id','comment','product'));
}
public function product_comments($product_id,$page=0){
 
    $per_page=10;
    $comments = Comment::with('answers')->where('product_id','=',$product_id)->where('comment_id','=',0)->orderBy('id','DESC');
    $page_count = ceil($comments->count() / $per_page);
    $comments = $comments->offset(($page*$per_page))->limit($per_page)->get();
  //  return $bids;
  //  return $page."::".$product_id.":".$page_count."::".$bids->count();
  return view('front.partials.product_comments_inner',compact('comments','page_count','page','product_id'));
}
    public function product_detail($slug,$id){
        try {
            $product = Product::with('images','user','bids','category','comments')->where('slug', $slug)->findOrFail($id);


            $title = $product['title'];
            $cat_array = [];
            foreach($product->category()->first()->parentTree() as $ca){
                $cat_array[]=['name'=>$ca['name'],'slug'=>$ca['slug']];
            }
            $similar = Product:: whereNotNull('verified')->where('id','<>',$product['id'])
            ->inRandomOrder()->limit(8)->get();

            if(!Auth::id()){
                Session::put('return_link',route('product_detail',[$product['slug'],$product['id']]));
            }else{
                Session::forget('return_link');
            }
            return view('front.product_detail',compact('product','cat_array','title','similar' ));
        } catch (ModelNotFoundException $e) {
            // Automatically return a 404 page
          //  abort(404);
          return view('front.not_found');
        }


    }

    private function product_win(Product $product){
         $product->update(['winner_id'=> Auth::id()]);

         Mail::to($product->winner()->first()->email)->send(new ProductWinMail());
    }

    public function make_offer(Request $request){
        if(Auth::id()){
            try{
                $product = Product::find($request['product_id']);
                if($product['new_price']+$request['users_bid']<$product['buy_now_price']){
                    $bid =$request['users_bid'];
                    $new_price =  (($product['new_price']>0)?$product['new_price']:$product['current_price'])+$request['users_bid'];
                    $msg = $new_price . " TL  Teklifiniz başarı ile alınmıştır ,teşekkür ederiz";


                }else{
                    $new_price = $product['buy_now_price'];
                    $bid = $product['buy_now_price']-$product['new_price'];
                    $msg = $new_price. " TL Teklifiniz ile ürünü kazandınız ,tebrik ederiz";
                    $this->product_win($product);


                }


                     $pb = new ProductBid();
                     $pb->product_id = $request['product_id'];
                     $pb->user_id = Auth::id();
                     $pb->bid_price = $bid;
                     $pb->save();


                     $product->new_price = $new_price;
                     $product->save();


                 return  $this->success([''], $msg,201);


             }catch (Exception $e){
                // return response()->json(['error' => $e->getMessage()], 500);
                 return  $this->error([''], $e->getMessage() ,500);
             }
        }
    }
}
