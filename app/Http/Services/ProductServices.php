<?php


namespace App\Http\Services;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\GeneralHelper;
 
use App\Models\ProductImage;
//use Illuminate\Support\Facades\Log;
class ProductServices{

    private $allowed_array = ['jpg', 'jpeg','png'];

  
       
       public function create_icon(Request $request,$slug){
   
          
           $icon = "";
           $file = $request->file('icon');
          
           if ($request->hasFile('icon')) {
                
               $ext = GeneralHelper::findExtension($file->getClientOriginalName());
               if (in_array($ext, $this->allowed_array)) {
               $path = public_path("files/products/" . $slug);
               $filename = GeneralHelper::fixName($request['title']) . "_" . date('YmdHis') . "." . GeneralHelper::findExtension($file->getClientOriginalName());
               $file->move($path, $filename);
              
               $path = public_path("files/products/" . $slug . "/" . $filename);
   
   
              $resizedImage = Image::make($path)->resize(100, null, function ($constraint) {
                  $constraint->aspectRatio();
              });
              $resizedImage->save(public_path("files/products/" . $slug . "/100h".$filename));
              $resizedImage = Image::make($path)->resize(500,500, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resizedImage->save(public_path("files/products/" . $slug . "/500x500".$filename));
            $resizedImage = Image::make($path)->resize(1000,null, function ($constraint) {
                $constraint->aspectRatio();
            });

            ///for carousel
            $resizedImage->save(public_path("files/products/" . $slug . "/1000w".$filename));
              $icon = $filename;
   
              }
   
         }
         return $icon;
       }/// upload icon
   
   
       public function upload_multi_files(Request $request,Product $product){
           if ($request->hasFile('multiple_files')) {
           
               $files = $request->file('multiple_files');
               $rank = ProductImage::where('product_id','=',$product->id)->count() +1;
              
                 
               foreach ($files as $file) {
                   $ext = GeneralHelper::findExtension($file->getClientOriginalName());
                   if (in_array($ext, $this->allowed_array)) {
                   $path = public_path("files/products/" . $product['slug']);
                   $filename =  rand(1000,99999). "_" . date('YmdHis') . "." . GeneralHelper::findExtension($file->getClientOriginalName());
                   $file->move($path, $filename);
                   // echo $file; 
                   $path = public_path("files/products/" . $product['slug'] . "/" . $filename);
   
                  $resizedImage = Image::make($path)->resize(200, null, function ($constraint) {
                      $constraint->aspectRatio();
                  });
   
   
                   $resizedImage->save(public_path("files/products/" . $product['slug'] . "/200".$filename));
                  $image200 ="200".$filename;
   
                  $resizedImage = Image::make($path)->resize(50, null, function ($constraint) {
                   $constraint->aspectRatio();
               });
   
   
                $resizedImage->save(public_path("files/products/" . $product['slug'] . "/50".$filename));
               $image50 ="50".$filename;
                       ProductImage::create([
                           'product_id'=>$product['id'],
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
         
   
       public function deleteProduct(Product $product){
           $dir = 'files/products/'.$product->slug."/";
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
           ProductImage::where('product_id','=',$product->id)->delete();
          }
   
       }
}