<?php

namespace App\Http\Controllers;
use App\Contracts\CrudControllerInterface;
use App\Http\Services\ProductServices;
use Illuminate\Http\Request;
use App\Models\Product;
use Exception;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Helpers\GeneralHelper;
use App\Models\ProductImage;
//use App\Mail\UserCreatedEmail;
///use App\Models\User;
//use App\Models\Category;


class ProductController extends Controller implements CrudControllerInterface
{
    use HttpResponses;
    private $service ;
    public function __construct(ProductServices $service){
        $this->service =  $service;
    }


    public function index($verified=0)

    {

 

        
        $products = Product::with('category','user');
        if($verified>0){
            $products->whereNull('verified');
        }
        $products =  $products->orderBy('updated_at','DESC')->get();

        $products->each(function ($product) {
            if ($product->category) {
                $product->category->append('parent_tree');
            }
        });

      
        
       

        return view('admin.panel.products.index',['products'=>$products]);
    }

    public function check_slug($slug,$id=0 ){
        $ch = Product::where('slug','=',$slug)->where('id','<>',$id) ->first();
            if($ch){
                return response()->json('bu isimde başka bir ürün mevcut');
            }
        
        
        return response()->json("ok");
        }
    public function create(){
        return view('admin.panel.products.create' );
    }
    public function store(Request $request){
    
      //  return $request;
        try{
            
            $icon = $this->service->create_icon($request,$request['slug']);
           
            $product= Product::create([
                'title'=>$request['title'],
                'slug'=>$request['slug'],
                'start_price'=>$request['start_price'],
                'current_price'=>$request['start_price'],
                'buy_now_price'=>$request['buy_now_price'],
                'bid_price'=>$request['bid_price'],
                'description'=>$request['product'],
                'category_id'=>$request['selected_category_id'],
                'user_id'=>Auth::user()->id,
                'youtube_link'=>$request['youtube_link'],
                'icon'=>$icon,
                'winner_id'=>0,
                'verified'=>(!empty($request['verified']))? now(): null,
                 'prologue'=>$request['prologue'],

            ]);

  
        $this->service->upload_multi_files($request,$product);
            
            return  $this->success([''],"Ürün Eklendi" ,201);
        }catch (Exception $e){
        
            return  $this->error([''], $e->getMessage() ,500);
        } 
    }
    public function show($id){

    }
    public function edit($id,$tab=0){
        $product = Product::with('images','user','verified_by')->find($id);
        
 
        return view('admin.panel.products.update',['product'=>$product
        ,'tab'=>$tab
        ,'product_txt'=>str_replace("\"","'",($product['description'])),'youtube_link'=>  (!empty($product['youtube_link'])) ? GeneralHelper::makeYouTube($product['youtube_link']) : '' ]);
    }
    public function update(Request $request ){
        try{
            $product = Product::find($request['id']);
            if($request['slug']!=$product['slug']){
                rename(public_path('files/products/'.$product->slug."/"),public_path('files/products/'.$request['slug']."/"));
            }
            $icon = $this->service->create_icon($request,$request['slug']);
            if(!empty($icon)  ){
                if( !empty($category['icon'])){
               @unlink(public_path('files/products/'.$request['slug']."/".$product->icon));
                @unlink(public_path('files/products/'.$request['slug']."/".substr($product->icon,3)));
                    }
                $product->icon = $icon;
               
            }
          
            $product->title = $request['title'];
            $product->slug = $request['slug'];
            $product->category_id = $request['selected_category_id'];
            $product->description = $request['product'];
            $product->start_price = $request['start_price'];
            $product->buy_now_price = $request['buy_now_price'];
            $product->bid_price = $request['bid_price'];
            $product->youtube_link = $request['youtube_link'];
            $product->verified = (!empty($request['verified']))? ((!empty($product['verified']))?$product['verified'] : now()) : null;
            $product->verified_by = (!empty($request['verified']))? ((!empty($product['verified_by']))?$product['verified_by'] : Auth::user()->id) : 0;
          
            $product->prologue = $request['prologue'];
             $product->save();
     
          return  $this->success([''],"Ürün Güncellendi" ,200);
        }catch (Exception $e){
           // return response()->json(['error' => $e->getMessage()], 500);
            return  $this->error([''], $e->getMessage() ,500);
        } 
    }

    public function update_product_images(Request $request){
        try{
            $product = Product::find($request['id']);
          
            $this->service->upload_multi_files($request,$product);
          
          return  $this->success([''],"Ürün resimleri Güncellendi" ,200);
        }catch (Exception $e){
           // return response()->json(['error' => $e->getMessage()], 500);
            return  $this->error([''], $e->getMessage() ,500);
        } 
    }

    public function destroy(Request $request)
    {
   
        $product = Product::find($request['id']);
       
            $this->service->deleteProduct($product);
        $product->delete();
        return redirect()->route('products.index');
    }
    public function show_product_images( $product_id,$img_id=0,$rank=0 ){
       

        if($img_id>0 && $rank>0){
                $img = ProductImage::find($img_id);

                if($rank>$img['rank']){
                    ProductImage::where('id', '!=', $img['id'])
                        ->where('rank','>',$img['rank'])
                        ->where('product_id','=',$img['product_id'])
                        ->where('rank','<=',$rank)->decrement('rank',1);
                }else{
                    ProductImage::where('rank','<',$img['rank'])
                        ->where('rank','>=',$rank)
                        ->where('product_id','=',$img['product_id'])
                        ->where('id', '!=', $img['id'])
                        ->increment('rank',1);
                }   
                $img->rank = $rank;
                $img->save();

        }////change

        $images = ProductImage::where('product_id','=',$product_id);
        return view('admin.panel.products.product_images',[ 
            'count'=>$images->count(),'images'=>$images->orderBy('rank')->get()]);
    }

    public function delete_product_image($img_id){
        $img = ProductImage::find($img_id);
 
        unlink(public_path('files/products/'.$img->product()->first()->slug."/".$img->image));
        unlink(public_path('files/products/'.$img->product()->first()->slug."/".$img->image200));
        unlink(public_path('files/products/'.$img->product()->first()->slug."/".$img->image50));
        ProductImage:: where('product_id','=',$img['product_id'])
        ->where('rank','>=',$img['rank'])->decrement('rank',1);
         $img->delete();
        return response()->json("ok");
    }

    public function show_image($type='image',$id){
       
        if($type=='image'){
            $image = ProductImage::find($id);
         
            $img= 'files/products/'.$image->product()->first()->slug.'/'.$image->image;
        }else{
            $image = Product::find($id);
           
            $img= 'files/products/'.$image->slug.'/'.substr($image->icon,3);
        }

        return view('admin.panel.products.show_image',[ 
            'img'=>$img]);
    }
}
