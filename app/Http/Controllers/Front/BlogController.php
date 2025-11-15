<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\ModelNotFoundException;
class BlogController extends Controller
{

    use HttpResponses;
    public function blog_detail($slug,$id){
        try {
            $blog = Blog::with('images','user' ,'category')->where('slug', $slug)->findOrFail($id);
            $title = $blog['title'];
            $cat_array = [];
            foreach($blog->category()->first()->parentTree() as $ca){
                $cat_array[]=['name'=>$ca['name'],'slug'=>$ca['slug']];
            }



            if(!Auth::id()){
                Session::put('return_link',route('blog_detail',[$blog['slug'],$blog['id']]));

//                return Session::get('return_link');
            }else{
                Session::forget('return_link');
            }
        //    return view('front.blog_detail',compact('blog','cat_array','title'));
            return view('front.detail',compact('blog','cat_array','title'));
        } catch (ModelNotFoundException $e) {
            // Automatically return a 404 page
            //abort(404);
            return view('front.not_found');
        }
    }
}
