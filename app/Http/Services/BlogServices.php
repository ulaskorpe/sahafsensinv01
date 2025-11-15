<?php

namespace App\Http\Services;
use App\Models\Blog;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\GeneralHelper;
use App\Models\Category;
use App\Models\BlogImage;
use Illuminate\Support\Facades\Log;
class BlogServices{
    private $allowed_array = ['jpg', 'jpeg','png'];

  
 
    public function create_icon(Request $request,$slug){

       
        $icon = "";
        $file = $request->file('icon');
       
        if ($request->hasFile('icon')) {
             
            $ext = GeneralHelper::findExtension($file->getClientOriginalName());
            if (in_array($ext, $this->allowed_array)) {
            $path = public_path("files/blogs/" . $slug);
            $filename = GeneralHelper::fixName($request['title']) . "_" . date('YmdHis') . "." . GeneralHelper::findExtension($file->getClientOriginalName());
            $file->move($path, $filename);
           
            $path = public_path("files/blogs/" . $slug . "/" . $filename);


           $resizedImage = Image::make($path)->resize(100, null, function ($constraint) {
               $constraint->aspectRatio();
           });


            $resizedImage->save(public_path("files/blogs/" . $slug . "/100".$filename));

            $resizedImage = Image::make($path)->resize(1000, 430, function ($constraint) {
                $constraint->aspectRatio();
            });
 
 
             $resizedImage->save(public_path("files/blogs/" . $slug . "/1000x430".$filename));

             $resizedImage = Image::make($path)->resize(500, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
 
 
             $resizedImage->save(public_path("files/blogs/" . $slug . "/500x300".$filename));

           $icon = $filename;

           }

      }
      return $icon;
    }/// upload icon


    public function upload_multi_files(Request $request,Blog $blog){
        if ($request->hasFile('multiple_files')) {
        
            $files = $request->file('multiple_files');
            $rank = BlogImage::where('blog_id','=',$blog->id)->count() +1;
           
              
            foreach ($files as $file) {
                $ext = GeneralHelper::findExtension($file->getClientOriginalName());
                if (in_array($ext, $this->allowed_array)) {
                $path = public_path("files/blogs/" . $blog['slug']);
                $filename =  rand(1000,99999). "_" . date('YmdHis') . "." . GeneralHelper::findExtension($file->getClientOriginalName());
                $file->move($path, $filename);
               
                $path = public_path("files/blogs/" . $blog['slug'] . "/" . $filename);

               $resizedImage = Image::make($path)->resize(200, null, function ($constraint) {
                   $constraint->aspectRatio();
               });


                $resizedImage->save(public_path("files/blogs/" . $blog['slug'] . "/200".$filename));
               $image200 ="200".$filename;

               $resizedImage = Image::make($path)->resize(50, null, function ($constraint) {
                $constraint->aspectRatio();
            });


             $resizedImage->save(public_path("files/blogs/" . $blog['slug'] . "/50".$filename));
            $image50 ="50".$filename;
                    BlogImage::create([
                        'blog_id'=>$blog['id'],
                        'image'=>$filename,
                        'image200'=> $image200,
                        'image50'=> $image50,
                            'rank'=>$rank

                    ]);
                    $rank++;
               }
            }
             
        }
    }
      

    public function deleteBlog(Blog $blog){
        $dir = 'files/blogs/'.$blog->slug."/";
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
        BlogImage::where('blog_id','=',$blog->id)->delete();
       }

    }

 
}
