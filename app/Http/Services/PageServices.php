<?php


namespace App\Http\Services;
use App\Models\Page;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Log;
use App\Models\PageImage;
//use Illuminate\Support\Facades\Log;
class PageServices{

    private $allowed_array = ['jpg', 'jpeg','png'];

  
       
       public function create_icon(Request $request,$slug){
   
          
           $icon = "";
           $file = $request->file('icon');
          
           if ($request->hasFile('icon')) {
                
               $ext = GeneralHelper::findExtension($file->getClientOriginalName());
               if (in_array($ext, $this->allowed_array)) {
               $path = public_path("files/pages/" . $slug);
               $filename = GeneralHelper::fixName($request['title']) . "_" . date('YmdHis') . "." . GeneralHelper::findExtension($file->getClientOriginalName());
               $file->move($path, $filename);
              
               $path = public_path("files/pages/" . $slug . "/" . $filename);
   
   
              $resizedImage = Image::make($path)->resize(100, null, function ($constraint) {
                  $constraint->aspectRatio();
              });
              $resizedImage->save(public_path("files/pages/" . $slug . "/100h".$filename));
              $resizedImage = Image::make($path)->resize(500,500, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resizedImage->save(public_path("files/pages/" . $slug . "/500x500".$filename));
            $resizedImage = Image::make($path)->resize(1000,null, function ($constraint) {
                $constraint->aspectRatio();
            });

            ///for carousel
            $resizedImage->save(public_path("files/pages/" . $slug . "/1000w".$filename));
              $icon = $filename;
   
              }
   
         }
         return $icon;
       }/// upload icon
   
   
       public function upload_multi_files(Request $request,Page $page){
           if ($request->hasFile('multiple_files')) {
           
               $files = $request->file('multiple_files');
               $rank = PageImage::where('page_id','=',$page->id)->count() +1;
              
                 
               foreach ($files as $file) {
                   $ext = GeneralHelper::findExtension($file->getClientOriginalName());
                   if (in_array($ext, $this->allowed_array)) {
                   $path = public_path("files/pages/" . $page['slug']);
                   $filename =  rand(1000,99999). "_" . date('YmdHis') . "." . GeneralHelper::findExtension($file->getClientOriginalName());
                   $file->move($path, $filename);
                  
                   $path = public_path("files/pages/" . $page['slug'] . "/" . $filename);
   
                  $resizedImage = Image::make($path)->resize(200, null, function ($constraint) {
                      $constraint->aspectRatio();
                  });
   
   
                   $resizedImage->save(public_path("files/pages/" . $page['slug'] . "/200".$filename));
                  $image200 ="200".$filename;
   
                  $resizedImage = Image::make($path)->resize(150, null, function ($constraint) {
                      $constraint->aspectRatio();
                   });
                   
   
                $resizedImage->save(public_path("files/pages/" . $page['slug'] . "/150".$filename));


                Log::channel('data_check')->info($page['title']."::".$page['id']);
                         $image50 ="150".$filename;
                         $pi = new PageImage();
                         $pi->page_id = $page['id'];
                         $pi->image = $filename;
                         $pi->image200 = $image200;
                         $pi->image50 = $image50;
                         $pi->rank = $rank;
                         $pi->save();
                    //    PageImage::create([
                    //        'page_id'=>$page['id'],
                    //        'image'=>$filename,
                    //        'image200'=> $image200,
                    //        'image50'=> $image50,
                    //        'rank'=>$rank
   
                    //    ]);
                       $rank++;
                  }
               }
                
           }
       }
         
   
       public function deleteProduct(Page $page){
           $dir = 'files/pages/'.$page->slug."/";
          if(is_dir($dir)){
           $files = scandir($dir);
           foreach ($files as $file) {
               if ($file != '.' && $file != '..') {
                   $filePath = $dir . DIRECTORY_SEPARATOR . $file;
                   if(is_file($filePath)){
                       @unlink($filePath);
                       //echo $filePath."<br>";
                   }
               }
           }
           rmdir($dir);
           PageImage::where('page_id','=',$page->id)->delete();
          }
   
       }
}