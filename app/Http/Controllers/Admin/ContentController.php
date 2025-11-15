<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Enums\Languages;
use App\Http\Controllers\Helpers\GeneralHelper;
use App\Http\Services\ContentServices;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;
use Faker\Factory as Faker;
class ContentController extends Controller
{

    private $lang_array ;
    private $video_image_array ;

    private $submit_form = false;
    use HttpResponses;
    private $service ;
    public function __construct(ContentServices $service){

            $this->lang_array = array_keys(Languages::asArray());
            $this->video_image_array = ['image','second_image','third_image','forth_image','fifth_image','youtube_video'];
            $this->service =  $service;
    }


    public function changeLang ($type_id,$lang){
        $post = Post::where('type_id','=',$type_id)->where('lang','=',$lang)->first();
        return redirect()->route('content-update',$post['id']);
    }

    public function list($type,$lang='TR',$parent_id=0){

         $type = Type::where('slug','=',$type)->first() ;

         $fields = $this->getFields($type);

         if(in_array('parent_id',$fields)){
            $posts = Post::with('parent')->where('type_id','=',$type['id']);
            $parents = Post::where('type_id','=', Type::where('children',$type['slug'])->pluck('id')->first())
            -> where('lang','=',$lang)
            ->orderBy('count')->get();

            ;

            }else{
                $parents = null;
                $posts = Post::where('type_id','=',$type['id']);

            }

            $parent=null;
         if($parent_id){

          $posts = $posts->where('parent_id','=',$parent_id);
            $parent = Post::find($parent_id);
            $parent_title = $parent->title;
         }else{
            $parent_title = "";
         }



         if(in_array($lang,$this->lang_array)){
                $posts = $posts->where('lang','=',$lang);

         }


         return view('admin_panel.content_list',[
            'langs'=>$this->lang_array,'posts'=>$posts->get(),'type'=>$type,
            'parents'=>$parents ,
            'fields'=>$fields,'lang'=>$lang,'parent_id'=>$parent_id,'parent'=>$parent,'parent_title'=>$parent_title,
            'count'=> (in_array('count',$fields))?true:false]);
    }



    private function getFields($type){
        $array = explode(',',str_replace('\'','', $type['fields']));
        $arr = [];
        foreach($array as $a ){
            $arr[]=GeneralHelper::fixName($a);
        }
        return $arr  ;
    }

public function countSelect($cat_id,Type $type,$post_id = 0){

    $count = Post::where('type_id','=',$type['id'])
    ->where('parent_id','=',$cat_id)
    ->where('lang','=',session()->get('selectedLang'))->count();

    if($post_id>0){
        $post =Post::find($post_id);
        $count = ($cat_id == $post['parent_id']) ? $count : $count+1;
    }else{
        $post =null;
    }

    return view('admin_panel.partials.content_form.count',compact('type','post','count','cat_id'));
}
    public function create($type,$lang='tr',$parent_id=0){

        $type = Type::where('slug','=',$type)->first();
        if($type->single){
            die();
        }



        $fields = $this->getFields($type);

        $cats = [];
        if(in_array('faq_id',$fields)){

            $cats = Post::select('id','title')->where('type_id','=',51)
            ->where('lang','=', session()->get('selectedLang'))
            ->where('show_post','=',1)
            ->orderBy('count', 'ASC')->get();

        }
        $products  =[];
        if(in_array( 'product_id',$fields)){

            $products = Post::select('id','title')->where('type_id','=',6)
            ->where('lang','=', session()->get('selectedLang'))
            ->where('show_post','=',1)
            ->orderBy('count', 'ASC')->get();

        }
        $product_cats = [];

        if($type['id']==6){ /// products
                $product_cats =
                Post::select('id','title')->where('type_id','=',5)
                ->where('lang','=', session()->get('selectedLang'))
                ->where('show_post','=',1)
                ->orderBy('count', 'ASC')->get();
         }

        $tags = [];
        if(in_array('tags',$fields)){

            $tags = Post::select('id','title')->where('type_id','=',41)
            ->where('lang','=', session()->get('selectedLang'))
            ->where('show_post','=',1)
            ->orderBy('title', 'ASC')->get();

        }

        $count = Post::where('type_id','=',$type['id'])
        ->where('lang','=',$lang)->where('parent_id','=',$parent_id)->count();

        $parent=null;
        if($parent_id){

           $parent = Post::find($parent_id);
            $parent_id = $parent['id'];
        }

        $parent_cat = Type::where('children','=',$type['slug'])->first();

        if(!empty($parent_cat)){

            $parent_cats = Post::where('type_id','=',$parent_cat['id'])
            ->where('lang','=',session()->get('selectedLang'))->orderBy('count')->get();
        }else{

            $parent_cats  = [];
             $parent_cat = false;
        }




        return view('admin_panel.content_form',[ 'type'=>$type,'products'=>$products
        ,'fields'=>$fields ,'txt'=>$type['fields'],'langs'=>$this->lang_array,
        'parent_cat'=>$parent_cat,'parents_cats'=>$parent_cats,
        'lang'=>$lang,'count'=>$count,'product_cats'=>$product_cats,
        'post'=>null,'exe'=>"Ekle",'route'=>'content-create-post'
        ,'submit'=>$this->submit_form ,'parent'=>$parent ,'parent_id'=>$parent_id,
        'cats'=>$cats,'tags'=>$tags,
        'selected_tags'=>[],
        'video_image_array'=>$this->priority_array($fields)
    ]);
    }

    public function createPost(Request $request){

       try{



        $type= Type::find($request['type_id']);

        $fields = $this->getFields($type);
        $images = ['image','second_image','third_image','forth_image','fifth_image'];

        foreach($fields as $field){
            if(!in_array($field,$images)){

                    if($field=='show_home'){
                        $array[$field] =    (!empty($request['show_home']))?1:0;

                    }elseif($field == 'youtube_video'){

                        if($request['youtube_video']){
                            $array['youtube_video'] =  $this->youtube_post( $request ['youtube_video']);

                          //  dd( $this->youtube_post( $request ['youtube_video']));
                            }
                    }elseif($field == 'faq_id'){
                        if($type['id']==9){ ///ssss
                        $array['parent_id']=    ( $request['faq_id'] == 'NoCat')?0:$request['faq_id'];
                        }else{
                        $array['faq_id']=    ( $request['faq_id'] == 'NoCat')?0:$request['faq_id'];
                        }
                    // }elseif($field == 'product_id'){
                    //     $array[$field] =  $request[$field];

                    //     dd($request['product_id']);


                    }elseif($field == 'count'){
                        $array[$field] =    ( !empty( $request['count']) )?$request['count']:0;

                    }else{
                        $array[$field] =  $request[$field];
                    }

            }
        }


        $parent_id = 0;
        if (!empty($request['parent_id']) && is_numeric($request['parent_id'])) {
            $parent_id = (int) $request['parent_id'];
        }

        $array['parent_id'] =  $parent_id ;

        if($type->single ==1){
            $array['show_post']  =  1;
        }else{
            $array['show_post'] =  (!empty($request['show_post']))?1:0;
            $array['show_home']=  (!empty($request['show_post']))? ( (!empty($request['show_home']))?1:0) :0;
        }


//        dd($array);

        if(empty($request['id'])){
        $post =  Post::create($array);
        $exe = "Eklendi";
            } else {
                $exe = "Güncellendi";
                $post = Post::find($request['id']);
                if ($post) {




                    $post->update($array);
                }
            }

        if($request['copy_others']){
            foreach ($this->lang_array as $lang) {
                if ($lang !== $request['lang']) {
                    $newArray = $array;
                    $newArray['lang'] = $lang;

                     // Eğer post_id gibi ilişkili bir alan varsa ana post'a bağlamak için kullan
                    // $newArray['parent_id'] = $post->id; // örnek: çokdilli içerik için bağlama

                    Post::create($newArray);
                }
            }
        }


        if(in_array('tags',$fields)){
            foreach($request['tags'] as $t_id){
                DB::table('blog_tag')->insert([
                    'blog_id' => $post['id'],
                    'tag_id' => $t_id
                ]);

            }
                //$post->tags()->attach($request['tags']);

        }

   //     Log::channel('data_check')->info($request['content']);
        foreach($images as $img_field){

        if(in_array( $img_field,$fields)){

            $img =$this->service->create_image($request, $img_field,$type);

            $post->$img_field = $img;


            }

        }
        $post->save();



        return  $this->success([''],$type->name." ".$exe ,201);
    }catch (Exception $e){
        // return response()->json(['error' => $e->getMessage()], 500);
        return  $this->error([''], $e->getMessage() ,500);
    }


    }

    private function priority_array($fields){

        $video_image_array = [];
        if(in_array('priority',$fields)){

            foreach($this->video_image_array as $item){
                if(in_array($item,$fields)){
                    $video_image_array[]= $item;
                }
            }

        }

        return $video_image_array;

    }

    private function youtube_post( $video_link ){
        $host = parse_url($video_link, PHP_URL_HOST);
        $validHosts = ['www.youtube.com', 'youtube.com', 'youtu.be'];

        if (in_array($host, $validHosts)) {
            parse_str(parse_url($video_link, PHP_URL_QUERY), $params);
            $videoId = $params['v'] ?? null;
            return $videoId;

        }

        return null;
    }
    public function update($id){
        $post = Post::find($id);

        $type = Type::where('id','=',$post->type_id)->first();

       // dd($type->fields);
        $count = Post::where('type_id','=',$type['id'])
        ->where('parent_id','=',$post['parent_id'])
        ->where('lang','=',$post['lang'])->count();

        if($post['parent_id']>0){
            $parent = Post::find($post['parent_id']);
            $parent_id = $parent->id;

        }else{
            $parent = null;
            $parent_id = 0;
        }


        $fields = $this->getFields($type);

        $cats = [];
        if(in_array('faq_id',$fields)){

            $cats = Post::select('id','title')->where('type_id','=',51)

            ->where('lang','=', session()->get('selectedLang'))
            ->orderBy('count', 'ASC')->get();

        }

        $products  =[];
        if(in_array( 'product_id',$fields)){

            $products = Post::select('id','title')->where('type_id','=',6)
            ->where('lang','=', session()->get('selectedLang'))
            ->where('show_post','=',1)
            ->orderBy('count', 'ASC')->get();

        }

        $product_cats = [];

        if($type['id']==6){ /// products
                $product_cats =
                Post::select('id','title')->where('type_id','=',5)
                ->where('lang','=', session()->get('selectedLang'))
                ->where('show_post','=',1)
                ->orderBy('count', 'ASC')->get();


         }


        $tags = [];
        $selected_tags = [];
        if(in_array('tags',$fields)){

            $tags = Post::select('id','title')->where('type_id','=',41)
            ->where('lang','=', session()->get('selectedLang'))
            ->orderBy('count', 'ASC')->get();

            $selected = DB::table('blog_tag')->where('blog_id','=',$id)->get();

            foreach($selected as $item){

               $selected_tags[] = $item->tag_id;;
            }

        }

        if($type->slug == 'sub_treatment' || $type->slug =='treatment_images'){
            $routes  = ['TR'=>'/tedaviler','EN'=> '/treatments','DE'=> '/behandlungen'];
            $slug_link = $routes[session()->get('selectedLang')]."/".Str::slug($post['title'])."/".$post['id'];
        }else{
            $slug_link = "";
        }

        $parent_cat = Type::where('children','=',$type['slug'])->first();

        if(!empty($parent_cat)){
            $parent_cats = Post::where('type_id','=',$parent_cat['id'])
            ->where('lang','=',session()->get('selectedLang'))->orderBy('count')->get();
        }else{
            $parent_cats  = [];
             $parent_cat = false;
        }

        return view('admin_panel.content_form',[ 'type'=>$type,
        'products'=>$products,'parent_cats'=>$parent_cats,'parent_cat'=>$parent_cat
        ,'fields'=>$fields,'txt'=>$type['fields'],'langs'=>$this->lang_array,'lang'=>$post['lang'],'count'=>$count,
        'product_cats'=>$product_cats,
        'post'=>$post,'exe'=>"Güncelle",'route'=>'content-update-post','submit'=>$this->submit_form ,'parent_id'=>$parent_id,'parent'=>$parent,'cats'=>$cats,'slug_link'=>$slug_link,'tags'=>$tags,'selected_tags'=>$selected_tags,'video_image_array'=>$this->priority_array($fields)]);
    }


    public function updatePost(Request $request){


        try{
            $type= Type::find($request['type_id']);

            $fields = $this->getFields($type);


            $post = Post::find($request['id']);
            $old_count = $post['count'];
            $old_parent = $post['parent_id'];
            $images = ['image','second_image','third_image','forth_image','fifth_image'];

            foreach($fields as $field){
                if(!in_array($field,array_merge($images, ['lang','type_id']))){
                    if($field=='show_home'){

                        $post->show_home =  (!empty($request['show_home']))?1:0;
                    // }elseif($field == 'content_2'){

                    //     dd($post->$field);
                    }elseif($field == 'youtube_video'){

                        if($request['youtube_video']){
                        $post->youtube_video = $this->youtube_post( $request ['youtube_video']);
                        }
                    }elseif($field == 'faq_id'){
                        if($type['id']==9){
                            $post->parent_id =    ( $request['faq_id'] == 'NoCat')?0:$request['faq_id'];
                        }else{
                       $post->faq_id =    ( $request['faq_id'] == 'NoCat')?0:$request['faq_id'];
                         //   dd($request['faq_id']);
                        }
                    }elseif($field == 'parent_id'){
                        $post->parent_id =    ( $request['parent_id'] == 'NoCat')?0:$request['parent_id'];


                    }else{
                        $post->$field =  $request[$field];
                    }
                }
            }



            foreach($images as $img_field){

             if(in_array( $img_field,$fields)){
                $img = $this->service->create_image($request, $img_field,$type);

                if(!empty($img)){
                  File::delete(public_path('post_images/'.$post->$img_field));
                  File::delete(public_path('post_images/icon_'.$post->$img_field));

                  $resize_array = $this->service->resizeArray($type);
                  foreach($resize_array as $arr ){
                      File::delete(public_path("post_images"   . "/".$arr[0]."x".$arr[1].$post->$img_field));
                  }
                }

                        $post->$img_field = $img;

                }
                      //  Log::channel('data_check')->info($img.":::".$img_field);

                }

            }


            if($type->single ==1){
                $post->show_post =  1;
            }else{
                $post->show_post =  (!empty($request['show_post']))?1:0;
                $post->show_home =  (!empty($request['show_post']))? ( (!empty($request['show_home']))?1:0) :0;
            }

           $post->save();




            if(in_array('tags',$fields)){
                DB::table('blog_tag')->where('blog_id','=',$post['id'])->delete();

                foreach($request['tags'] as $t_id){
                    DB::table('blog_tag')->insert([
                        'blog_id' => $post['id'],
                        'tag_id' => $t_id
                    ]);

                }
                    //$post->tags()->attach($request['tags']);

            }

            if($post['count']>0){

if($old_parent == $post['parent_id']){

         if($post['count'] > $old_count){ // new> old
                Post ::where('id', '!=', $post['id'])
                    ->where('type_id','=',$post['type_id'])
                    ->where('parent_id','=',$post['parent_id'])
                    ->where('lang','=',$post['lang'])
                    ->where('count','>',$old_count)
                    ->where('count','<=',$post['count'])
                    ->decrement('count',1);
            }else{
                Post::where('id', '!=', $post['id'])
                    ->where('lang','=',$post['lang'])
                    ->where('parent_id','=',$post['parent_id'])
                    ->where('type_id','=',$post['type_id'])
                    ->where('count','>=',$post['count'])
                    ->where('count','<',$old_count)
                    ->increment('count',1);


            }

        }else{ // parent changed
          //  dd($post['count']);
            Post::where('id', '!=', $post['id'])
            ->where('lang','=',$post['lang'])
            ->where('parent_id','=',$post['parent_id'])
            ->where('type_id','=',$post['type_id'])
            ->where('count','>=',$post['count'])
            ->increment('count',1);

            Post::where('id', '!=', $post['id'])
            ->where('type_id','=',$post['type_id'])
            ->where('parent_id','=',$old_parent)
            ->where('lang','=',$post['lang'])
            ->where('count','>=',$post['count'])
            ->decrement('count',1);

        }

        }

            return  $this->success([''],$type->name." Güncellendi" ,200);
        }catch (Exception $e){
            // return response()->json(['error' => $e->getMessage()], 500);
            return  $this->error([''], $e->getMessage() ,500);
        }


    }


    private function deleteFiles($post){
        if(!empty($post['image'])){
            File::delete(public_path('post_images/'.$post['image']));
            File::delete(public_path('post_images/icon_'.$post['image']));
        }

        if(!empty($post['second_image'])){
            File::delete(public_path('post_images/'.$post['second_image']));
            File::delete(public_path('post_images/icon_'.$post['second_image']));
        }

        if(!empty($post['third_image'])){
            File::delete(public_path('post_images/'.$post['third_image']));
            File::delete(public_path('post_images/icon_'.$post['third_image']));
        }
    }

    public function deletePost($id){
        $post = Post::find($id);
        if($post->type()->first()->single){
            die();
        }
        $this->deleteFiles($post);

        Post::where('lang', '=', $post->lang)
        ->where('type_id', '=', $post->type_id)
        ->where('parent_id','=',$post->parent_id)
        ->where('id', '<>', $post->id)
        ->where('count', '>=', $post->count)
        ->decrement('count', 1);


        $post->delete();



        if(!empty($post['children'])){
                //$type = Type::where('slug','=',$post['children'])->first();
                $subs = Post::where('parent_id','=',$post['id'])->get();
                foreach($subs as $sub){
                    $this->deleteFiles($sub);
                    $sub->delete();
                }
        }

        return redirect('/admin-panel/content/list/'.$post->type()->first()->slug.'/'.$post['lang'].'/'.$post['parent_id']);

    }

    public function copyOthers(Request $request){
        $type = Type::where('slug','=',$request['slug'])->first();
        $post  = Post::where('type_id','=',$type->id)->where('lang','=',$request['lang'])->first();

        $lang_array =$this->lang_array;
        $fields = $this->getFields($type);
        $arr = "";
        foreach($lang_array as $lang){
            if($lang != $request['lang']){
                 $item  =  Post::where('type_id','=',$type->id)->where('lang','=',$lang)->first();
                if(empty($item)){
                    $item = new Post();
                }
                foreach($fields as $field){
                    if($field!='lang'){
                    $item->$field = $post[$field];
                    }else{

                        $item->lang = $lang;
                        $arr.=$item['lang']." ";
                    }
                }

                $item->save();
            }


        }


        return  $this->success([''],$type->name." ".$arr." dilleri Güncellendi" ,200);
    }


    public function emptyField($id, $field){
        $post = Post::find($id);
        $post->$field = "";
        $post->save();
        return redirect('/admin-panel/content/update/'.$post->id );
    }
}
