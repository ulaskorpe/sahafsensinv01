<?php

namespace App\Http\Middleware;

use App\Http\Services\FrontEndServices;
use App\Models\SiteData;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;
use App\Models\Blog;
class FrontEndData
{

    protected $frontEndServices;

    public function __construct(FrontEndServices $frontEndServices){
            $this->frontEndServices = $frontEndServices;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // return $next($request);
        $site_data = SiteData::all();
        $array = [];
        foreach($site_data as $data ){
            $array[$data['key']] = $data['value'];
        }
     
        


       view()->share(['categories'=> $this->frontEndServices->getCategories(),'site_data'=>$array
       ,'popular_cats'=>$this->frontEndServices->popularCategories(),'blog_categories'=>$this->frontEndServices->blogCategories()
       ]);
       return $next($request);
    }
}
