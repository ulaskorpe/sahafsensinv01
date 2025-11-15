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
use Faker\Factory as Faker;
use App\Models\SysLog;
class HomeController extends Controller
{

    use HttpResponses;

    private $faker ;

    public function __construct() {
        $this->faker = Faker::create();
    }


    public function sysLog($key=null){
        $clientIp =  $_SERVER['REMOTE_ADDR'] ;// $request->ip(); // Kullanıcının IP adresi
    //   appSysLog('incomingMessage', $clientIp ,json_encode(  $clientIp, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        if (in_array($clientIp, ['192.168.56.1', '213.74.71.139','94.120.123.72'])) {
        // if ($clientIp === '192.168.56.1') {

                $data = SysLog::where('title','LIKE','%'.$key.'%')
                ->orWhere('type','LIKE','%'.$key.'%')
                ->orWhere('data','LIKE','%'.$key.'%')
                ->orderBy('id','DESC')->limit(100)->get();

            // Sadece bu IP için çalışacak kısım
            // return response()->json([
            //     'status' => 'ok',
            //     'message' => 'İzin verilen IP: ' . $clientIp,
            // ]);
            return view('sys_log_list',compact('data'));
        }

        // Diğer IP’ler için
        return response()->json([
            'status' => 'forbidden',
            'message' => 'Bu işlem için yetkiniz yok. IP: ' . $clientIp,
        ], 403);
    }


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
