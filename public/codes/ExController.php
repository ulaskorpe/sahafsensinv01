<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExController extends Controller
{
    public function show_sub_categories($cat_id, Request $request){
  
 
        $cats = Category::select('id','name')->where('parent_id','=',$cat_id);
      //  if ($request->expectsJson()) {
        if (true) {
           
            $array = [];
         
            $categories = Category::select('id','name','parent_id')->where('parent_id','=',$cat_id);
    
            $array[]=['categories'=>$categories->orderBy('rank')->get(),'count'=>$categories->count()];
      
        
             return response()->json($array);
    
         //   return response()->json(['count'=>$cats->count(),'categories'=> $cats->orderBy('rank')->get()]);
        } else {
            // Return HTML view
            return view('admin.panel.categories.sub_categories', [
                'categories' => $cats->orderBy('rank')->get(),
            ]);
        }
        }
        public function select_count($cat_id){
            return  Category::select('id')->where('parent_id','=',$cat_id)->count();
        }
    

        public function show_upper_categories(Category $category){

      
            $parent_cat = $category['parent_id'];
            $up_cats = [];
        
            $i=0;
            while($parent_cat > 0){
                $parent = new CategoryResource(Category::find($parent_cat));
                if($parent['parent_id']>0){
                $up_cats[$i]=$parent; //['id'];
                $i++;
                }
                $parent_cat = $parent['parent_id'];
                
                
            }
            $cats = array_reverse($up_cats);
            $cats[]=new CategoryResource($category);
            
        
            //$cats = Category::where('parent_id','=',$cat_id);
            //if ($request->expectsJson()) {
                if (true) {
                       
                return response()->json(['count'=>$i,'categories'=>$cats ]);
            } else {
                // Return HTML view
                return view('admin.panel.categories.sub_categories', [
                    'categories' => $cats->orderBy('rank')->get(),
                ]);
            }
            
        }
}
