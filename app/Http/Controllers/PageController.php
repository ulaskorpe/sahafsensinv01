<?php

namespace App\Http\Controllers;
use App\Contracts\CrudControllerInterface;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Services\PageServices;
use App\Models\Page;
use App\Http\Controllers\Helpers\GeneralHelper;
use App\Models\PageImage;
use Exception;
class PageController extends Controller implements CrudControllerInterface
{
    use HttpResponses;
    private $service ;
    public function __construct(PageServices $service){
        $this->service =  $service;
    }

    public function index(){

        return view('admin.panel.pages.index',['pages'=>Page::all()]);

    }

    public function check_slug($slug,$id=0 ){
        $ch = Page::where('slug','=',$slug)->where('id','<>',$id) ->first();
            if($ch){
                return response()->json('bu isimde başka bir sayfa mevcut');
            }
        
        
        return response()->json("ok");
        }

    public function create(){
        return view('admin.panel.pages.create' );
    }
    public function store(Request $request){
        try{
            
            $icon = $this->service->create_icon($request,$request['slug']);
 
            $page = Page::create([
                'title'=>$request['title'],
                'slug'=>$request['slug'],
                'content'=>$request['content'],
                'youtube_link'=>$request['youtube_link'],
                'icon'=>$icon,
                'prologue'=>$request['prologue']

            ]);
            

  
             $this->service->upload_multi_files($request,$page);
            
            return  $this->success([''],"sayfa Eklendi" ,201);
        }catch (Exception $e){
        
            return  $this->error([''], $e->getMessage() ,500);
        } 

    }
    public function show($id){}
    public function edit($id){
        $page = Page::with('images')->find($id);
        
 
        return view('admin.panel.pages.update',['page'=>$page,'page_txt'=>str_replace("\"","'",($page['content'])),'youtube_link'=>  (!empty($page['youtube_link'])) ? GeneralHelper::makeYouTube($page['youtube_link']) : '' ]);

    }
    public function update(Request $request ){


        try{
            $page = page::find($request['id']);
            if($request['slug']!=$page['slug']){
                rename(public_path('files/pages/'.$page->slug."/"),public_path('files/pages/'.$request['slug']."/"));
            }
            $icon = $this->service->create_icon($request,$request['slug']);
            if(!empty($icon)  ){
                if( !empty($category['icon'])){
               @unlink(public_path('files/pages/'.$request['slug']."/".$page->icon));
                @unlink(public_path('files/pages/'.$request['slug']."/".substr($page->icon,3)));
                    }
                $page->icon = $icon;
               
            }
          
            $page->title = $request['title'];
            $page->slug = $request['slug'];
            
            $page->content = $request['content'];
            $page->youtube_link = $request['youtube_link'];
            
            $page->prologue = $request['prologue'];
             $page->save();
         
 
         
        $this->service->upload_multi_files($request,$page);
          
          return  $this->success([''],"sayfa Güncellendi" ,200);
        }catch (Exception $e){
           // return response()->json(['error' => $e->getMessage()], 500);
            return  $this->error([''], $e->getMessage() ,500);
        } 

    }
    public function destroy(Request $request){}

    public function show_page_images( $page_id,$img_id=0,$rank=0 ){
       

        if($img_id>0 && $rank>0){
                $img = PageImage::find($img_id);

                if($rank>$img['rank']){
                    PageImage::where('id', '!=', $img['id'])
                        ->where('rank','>',$img['rank'])
                        ->where('page_id','=',$img['page_id'])
                        ->where('rank','<=',$rank)->decrement('rank',1);
                }else{
                    PageImage::where('rank','<',$img['rank'])
                        ->where('rank','>=',$rank)
                        ->where('page_id','=',$img['page_id'])
                        ->where('id', '!=', $img['id'])
                        ->increment('rank',1);
                }   
                $img->rank = $rank;
                $img->save();

        }////change

        $images = PageImage::where('page_id','=',$page_id);
        return view('admin.panel.pages.page_images',[ 
            'count'=>$images->count(),'images'=>$images->orderBy('rank')->get()]);
    }
    public function delete_page_image($img_id){
        $img = PageImage::find($img_id);
 
        unlink(public_path('files/pages/'.$img->page()->first()->slug."/".$img->image));
        unlink(public_path('files/pages/'.$img->page()->first()->slug."/".$img->image200));
        unlink(public_path('files/pages/'.$img->page()->first()->slug."/".$img->image50));
        PageImage:: where('page_id','=',$img['page_id'])
        ->where('rank','>=',$img['rank'])->decrement('rank',1);
         $img->delete();
        return response()->json("ok");
    }
 
}
