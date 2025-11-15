<?php

namespace App\Http\Controllers;

use App\Http\Services\CategoryServices;
use App\Models\CategoryImage;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\GeneralHelper;
use App\Models\Category;
use Intervention\Image\Facades\Image;
 

use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    use HttpResponses;
    private $service ;
    public function __construct(CategoryServices $service){
        $this->service =  $service;
    }

    private function checkType($type){
        if(!in_array($type,['product','blog'])){
            return redirect('/admin-panel');
          }
    }


    public function index($type = 'product')
    {
        $this->checkType($type);
       
        $cats = $this->service->getCategories(0,$type);
        return view('admin.panel.categories.index',['categories'=>$cats['data'],'count'=>$cats['count'],'type'=>$type]);
    }

    public function create($type = 'product')
    {
        $this->checkType($type);

        $cats = $this->service->getCategories(0,$type);
        return view('admin.panel.categories.create',['categories'=>$cats['data'],'count'=>$cats['count'],'type'=>$type]);
    }

    
    public function store(Request $request)
    {
       
        $this->checkType($request['type']);
         try{
            
        
            $icon = $this->service->create_icon($request,$request['slug']);
        $category= Category::create([
            'name'=>$request['name'],
            'slug'=>$request['slug'],
            'type'=>$request['type'],
            'icon'=>$icon,
            'description'=>$request['description'],
            'parent_id'=>$request['selected_category_id'],
            'rank'=>$request['rank']
        ]);
     
        
        
 

        
            $this->service->upload_multi_files($request,$category);
        
        return  $this->success([''],"Kategori Eklendi" ,201);
    }catch (Exception $e){
       // return response()->json(['error' => $e->getMessage()], 500);
        return  $this->error([''], $e->getMessage() ,500);
    } 

       

    }
    public function check_slug($slug,$type,$id=0 ){
    $ch = Category::where('slug','=',$slug)
        ->where('id','<>',$id)  
        ->where('type','=',$type) ->first();
        if($ch){
            return response()->json('bu isimde başka bir kategori mevcut');
        }
    
    
    return response()->json("ok");
    }
    
    public function show($id)
    {
        // Show the specified resource
    }

    public function edit($slug)
    {
       
        
        try{
            
            
            return view('admin.panel.categories.update',[ 
            'category'=>Category::where('slug','=',$slug)->first()]);

        }catch(Exception $exception){
            return response()->json( $exception->getMessage());
        }


    }

    public function update(Request $request )
    {
 
        try{
            $category = Category::find($request['id']);
            $icon = $this->service->create_icon($request,$category->slug);
            
            if(!empty($icon)  ){
                if( !empty($category['icon'])){
               @unlink(public_path('files/categories/'.$category->slug."/".$category->icon));
                @unlink(public_path('files/categories/'.$category->slug."/".substr($category->icon,3)));
                    }
                $category->icon = $icon;
               
            }
          
            $category->name = $request['name'];
            $category->slug = $request['slug'];
            $category->description = $request['description'];
            $category->parent_id = $request['selected_category_id'];
            $category->rank = $request['rank'];
             $category->save();
          
         
            $this->service->upload_multi_files($request,$category);
            
            return  $this->success([''],"Kategori Güncellendi" ,200);
        }catch (Exception $e){
           // return response()->json(['error' => $e->getMessage()], 500);
            return  $this->error([''], $e->getMessage() ,500);
        } 
    }

    public function destroy(Request $request)
    {
        try{
          $this->service->getTree($request['id']);
         $categories = Category::with('images')->whereIn('id', $this->service->cats_array)->get();
         foreach($categories as $category){
            $this->service->decrese_rank($category);
            $this->service->deleteCategory($category);
            
         }
         Category::whereIn('id',$this->service->cats_array)->delete();
         return redirect()->route('categories.index');
        }catch (Exception $e){
            // return response()->json(['error' => $e->getMessage()], 500);
             return  $this->error([''], $e->getMessage() ,500);
         } 
        // Remove the specified resource
    }

    public function show_sub_categories($cat_id,$type){
       
        //   return response()->json("ok".$cat_id);
        $cats = $this->service->getCategories($cat_id,$type);
        if($cats['count']){
        return view('admin.panel.categories.sub_categories',['categories'=>$cats['data'],'count'=>$cats['count']]);
       }else{
           return "Alt kategori yok";
       }
       }
    public function show_up_categories($cat_id){
        
        $category = Category::select('id','name','parent_id')->find($cat_id);
        $parent_id =  $category['parent_id'];
        $array = ['cat_select_'.$category['parent_id']];
        while($parent_id > 0){
            $category = Category::find($parent_id);
            $parent_id =  $category['parent_id'];
            if($parent_id>0){
            array_push($array,'cat_select_'.$parent_id) ;
            }
        }

        return response()->json( ['data'=> $array]);
    }

    public function select_categories($cat_id,$type='product',$show=true){
        $array = [];
        if($cat_id == 0){
         $subs = null;
         $cats= Category::where('parent_id','=',0)->where('type','=',$type);
         $up_categories =['categories'=>$cats->orderBy('rank')->get()];
         $count = $cats->count();
         $selected_category = null;
        }else{

       
        $selected_category = Category::select('id','name','parent_id','type')->find($cat_id);
        $count = Category::where('parent_id','=',$selected_category['parent_id'])->where('type','=',$selected_category['type'])->count();
        $parent_id =  $selected_category['parent_id'];
        $array[]=[$this->service->find_siblings($selected_category),'selected'=>$selected_category['id']];
         
        while($parent_id > 0){
            $category = Category::find($parent_id);
            $parent_id =  $category['parent_id'];
            
            $array[]=[$this->service->find_siblings($category ),'selected'=>$category['id']];
        }
        
        $sub_cats = Category::select('id','name','parent_id')->where('parent_id','=',$cat_id);
        $subs=['categories'=>$sub_cats->orderBy('rank')->get(),'count'=>$sub_cats->count()];

        $up_categories =  array_reverse($array);

    }
         
    $data = ['up_categories'=>$up_categories,'sub_categories'=>$subs
    ,'selected_category'=>$selected_category,'count'=>$count,'type'=>$type,'show'=>$show];
    //return response()->json($data);
        return view('admin.panel.categories.categories_div',$data);
 
    }
    
   
    

   

    public function show_category_images($cat_id,$img_id=0,$rank=0 ){
       

        if($img_id>0 && $rank>0){
                $img = CategoryImage::find($img_id);

                if($rank>$img['rank']){
                    CategoryImage::where('id', '!=', $img['id'])
                        ->where('rank','>',$img['rank'])
                        ->where('category_id','=',$img['category_id'])
                        ->where('rank','<=',$rank)->decrement('rank',1);
                }else{
                    CategoryImage::where('rank','<',$img['rank'])
                        ->where('rank','>=',$rank)
                        ->where('category_id','=',$img['category_id'])
                        ->where('id', '!=', $img['id'])
                        ->increment('rank',1);
                }   
                $img->rank = $rank;
                $img->save();

        }////change

        $images = CategoryImage::where('category_id','=',$cat_id);
        return view('admin.panel.categories.category_images',[ 
            'count'=>$images->count(),'images'=>$images->orderBy('rank')->get()]);
    }


    public function delete_category_image($img_id){
        $img = CategoryImage::find($img_id);
 
        unlink(public_path('files/categories/'.$img->category()->first()->slug."/".$img->image));
        unlink(public_path('files/categories/'.$img->category()->first()->slug."/".$img->image200));
        unlink(public_path('files/categories/'.$img->category()->first()->slug."/".$img->image50));
        CategoryImage:: where('category_id','=',$img['category_id'])
        ->where('rank','>=',$img['rank'])->decrement('rank',1);
         $img->delete();
        return response()->json("ok");
    }

    public function show_image($type='image',$id){
        if($type=='image'){
            $image = CategoryImage::find($id);
            $img= 'files/categories/'.$image->category()->first()->slug.'/'.$image->image;
        }else{
            $image = Category::find($id);
            $img= 'files/categories/'.$image->slug.'/'.substr($image->icon,3);
        }

        return view('admin.panel.categories.show_image',[ 
            'img'=>$img]);
    }

    

}
