<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Services\FrontService;
use App\Models\Counter;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;


class SiteData
{

    protected $frontServices;

    public function __construct(FrontService $frontServices){
            $this->frontServices= $frontServices;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(empty(session()->get('selectedLang'))){
            session()->put('selectedLang','tr');

        }

        $ip ='94.120.125.21';//request()->ip();
        $response = file_get_contents("http://ip-api.com/json/{$ip}?fields=status,message,country,regionName,city,lat,lon,query");
        $data = json_decode($response, true);


        if ($data['status'] === 'success') {
            // echo "Country: " . $data['country'] . "<br>";
            // echo "City: " . $data['city'] . "<br>";
            $counter = Counter::where('ip_address','=',$ip)->where('date','=',today())->first();
            if(empty($counter)){
                $counter = new Counter();
                $counter->ip_address = $ip;
                $counter->count = 1;
                $counter->country = $data['country'];
                $counter->city = $data['regionName'] .'-'.$data['city'];
                $counter->date =today();
            }else{
                $counter->count = $counter['count']+1;
            }

            $counter->save();


        //} else {
         //   echo "Error: " . $data['message'];
        }


//if(empty(session()->get('siteData'))){
if(true){


        $top_banner = Post::where('type_id','=',3)
        ->where('lang','=',session()->get('selectedLang'))->orderBy('count')->first();

          // dd(session()->get('selectedLang'));



        $routes = [
            'about_us' =>  ['tr'=>'/hakkimda','en' =>'/about-me','de'=> '/uber-uns'],
            'contact' =>  ['tr'=>'/bana-ulasin', 'en'=>'/contact-me'],
            'galleries' =>  ['tr'=>'/galeriler', 'en'=>'/galleries'],
            'gallery_detail' =>  ['tr'=>'/galeri-detay', 'en'=>'/gallery-detail'],
            'videos' =>  ['tr'=>'/videolar', 'en'=>'/videos'],
            'blogs' =>  ['tr'=>'/bloglar', 'en'=>'/blogs'],
            'blog_detail' =>  ['tr'=>'/blog-detay', 'en'=>'/blog-detail'],


        ];




        $siteData =  [
            'selectedLang' => session()->get('locale'),
            'languages' => ['en','tr']  ,

            'routes'=>$routes
        ];
        session()->put('siteData',$siteData);
    }else{
        $siteData = session()->get('siteData');

      //  dd($siteData);
    }

     $routes = $siteData['routes'];



        View::share(compact('routes', 'top_banner','siteData'));

        return $next($request);
    }
}
