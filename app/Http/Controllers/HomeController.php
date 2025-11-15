<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
//use Illuminate\Http\Request;
use App\Models\Page;
//use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Mail;

// use App\Mail\ProductUpdatedMail;
// use App\Mail\UserCreatedEmail;
use App\Traits\HttpResponses;
use App\Models\Product;
use App\Models\Blog;
use App\Models\FAQ;
class HomeController extends Controller
{

    use HttpResponses;
    public function index(){

         
        $carousel = Product::select('id','title','icon','prologue','slug')
        ->whereNotNull('verified')
        ->inRandomOrder()->limit(3)->get();

        $blogs = Blog::select('title','icon','prologue','slug','id')
        ->inRandomOrder()->limit(2)->get();

 
        $recent = Product:: whereNotNull('verified')
        ->inRandomOrder()->limit(8)->get();

        return view('front.index' , ['blogs'=>$blogs
        ,'recent'=>$recent
        ,'carousel'=>$carousel]);
        
           /// return response()->redirectTo('/login');
    }

    public function category_detail($slug,$id){
        return $slug;
    }

    public function product_detail($slug,$id){
        return $slug;
    }

    public function product_list($category_slug=null,$key=null,$page=0){
        return $category_slug;
    }
    public function blogs($key=null,$page=0){
        return $key;
    }

    public function blog_detail($slug,$id){
        return $slug;
    }
    public function faqs(){
        return view('front.sss');
    }
    public function faqin($q=''){
 
        $faqs = FAQ::where('id','>',0);
        if($q!=''){
            $faqs = $faqs->where('question','LIKE',"%{$q}%");
        }
       $faqs = $faqs->orderBy('rank')->get();
         
        return view('front.partials.faqin',['faqs'=>$faqs]);
    }

    public function fetch_page($page_id){

        $page = Page::with('images')->find($page_id);
        return response()->json(['title'=>$page['title'],
        'body'=>$page['content']
        ,'icon'=>$page['icon'],
        'slug'=>$page['slug'],
        'images'=>$page->images()->get()]);
    }
 

    private function createToken(User $user){
        $token = $user->createToken('API Token of'.$user->name)->plainTextToken;
        Session::put('token',$token);
        return $token;
    }
 

}
