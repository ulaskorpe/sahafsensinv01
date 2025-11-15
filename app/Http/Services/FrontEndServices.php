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
use App\Models\Post;
use App\Models\Type;
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


    /// krp



    public function splitText($text) {
        // $length = strlen($text);
        // $half = ceil($length / 2); // Get the middle index, rounded up

        // $part1 = substr($text, 0, $half);
        // $part2 = substr($text, $half);

        // return [$part1, $part2];
        $words = explode(' ', $text); // Split text into words
        $totalWords = count($words);
        $half = ceil($totalWords / 2); // Get middle index, rounded up

        $part1 = implode(' ', array_slice($words, 0, $half)); // First half
        $part2 = implode(' ', array_slice($words, $half));    // Second half

        return [$part1, $part2];
    }

    public function findType($slug){

        return Type::where('slug','=',$slug)->pluck('id')->first();


     }
     public function fetchData($array,$get=true){

        $type_array = Type::whereIn('slug',$array)->pluck('id')->toArray();

        if(is_array($array)){
        $data = Post::with('type')->whereIn('type_id',$type_array);
        }else{
            $data = Post::with('type')->where('type_id','=',$type_array);
        }
        $data= $data
        ->where('lang','=',session()->get('locale'))
        ->where('show_post','=',1) ;

   
        return ($get) ? $data->get() : $data;
     }

     public function getData($array,$limit=0,$faq_id= 0,$parent_id= 0,$orderBy=['count','asc']){

       $type_array = Type::whereIn('slug',$array)->pluck('id')->toArray();
       
        if(is_array($array)){
        $data = Post::with('type')->whereIn('type_id',$type_array);
        }else{
            $data = Post::with('type')->where('type_id','=',$type_array);
        }
        $data= $data
        ->where('lang','=',session()->get('locale'))
        ->where('show_post','=',1) ;
           if($faq_id){
               $data = $data->where('parent_id','=',$faq_id);
           }
           if($parent_id){
               $data = $data->where('parent_id','=',$parent_id);
           }
           $data = $data->orderBy($orderBy[0],$orderBy[1]);
           if( $limit >  0){
            $data = $data ->limit($limit);
   
           }
           return $data->get();
        }
        public function commonData( $array = []) {
   
             $posts = $this->fetchData($array);
             $data = [];
             foreach($posts as $post) {
                 //  $data[$]
             }
   
             return $data;
        }
     public function addSlug($data , $route_name=""){
        foreach($data as $item){

            $item->slug =  Str::slug($item->title);
            if($route_name != ''){
            $item->formatted_link = $route_name.'/'.$item->slug.'/'.$item->id;

            }
        }
        return $data;
     }



     public function getOne($type){
        $data = $data =    Post::where('type_id','=',$type)
        ->orWhere('slug','=',$type)
        ->where('lang','=',session()->get('locale'))
        ->where('show_post','=',1)->first();
        return $data;
     }
}