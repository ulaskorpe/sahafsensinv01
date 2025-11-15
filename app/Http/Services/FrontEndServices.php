<?php

namespace App\Http\Services;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Traits\CapthaTrait;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontEndServices
{

    use CapthaTrait;
    private $allowed_array = ['jpg', 'jpeg','png'];

 
    public function getCategories()
    {

        
        return Category::with('subcategory')->where('parent_id','=',0)
        ->where('type','=','product')
        ->orderBy('rank')->get();
    }

    public function blogCategories()
    {
       
        return Category::with('subcategory')->where('parent_id','=',0)
        ->where('type','=','blog')
        ->orderBy('rank')->get();
    }

    public function popularCategories(){
        $categories = Category::where('type', 'product')
        ->where('product_count','>',0)
        ->orderBy('product_count', 'DESC')
        ->limit(8)
        ->get();

    // Attach the parent tree to each category
    foreach ($categories as $category) {
        $category->parent_tree = $category->parentTree();
    }

    return $categories;
    }

    public function pick_items($count = 4){
        return Product::whereNotNull('verified')->inRandomOrder()->take($count)->get();
    }

    public function generateUserCode(){
        $ch=true;
        while($ch){
            $token = rand(100000,999999);
            $user = User::where('user_code','=',$token)->first();
            $ch = (!empty($user))?true:false;
        }
        return $token;
    }
    
    public function create_avatar(Request $request){
        $user = User::where('user_code','=',Session::get('user_code'))->first();
          
        $avatar = $user['avatar'];
        $file = $request->file('avatar');
       
        if ($request->hasFile('avatar')) {
          
            $ext = GeneralHelper::findExtension($file->getClientOriginalName());
            if (in_array($ext, $this->allowed_array)) {
            $path = public_path("files/users/" .  $user['id'] );
            $filename = GeneralHelper::fixName($request['name']) . "_" . date('YmdHis') . "." . GeneralHelper::findExtension($file->getClientOriginalName());
            $file->move($path, $filename);
           
            $path = public_path("files/users/" .$user['id']. "/" . $filename);


           $resizedImage = Image::make($path)->resize(200, null, function ($constraint) {
               $constraint->aspectRatio();
           });
           $resizedImage->save(public_path("files/users/" .$user['id'].  "/200h".$filename));
           $resizedImage = Image::make($path)->resize(500,500, function ($constraint) {
             $constraint->aspectRatio();
         });
           $avatar = $filename;
           }

      }
      return $avatar;
    }
}