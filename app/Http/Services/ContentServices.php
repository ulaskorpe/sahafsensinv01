<?php

namespace App\Http\Services;
use App\Models\Post;
use App\Models\Type;
use App\Enums\Languages;

//use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
class ContentServices
{
    private $allowed_array = ['jpg', 'jpeg','png','gif','svg'];

    public function resizeArray(Type $type){
        $resizeFields = $type->relationLoaded('resizeFields')
        ? $type->resizeFields
        : $type->resizeFields()->get();

    return $resizeFields
        ->map(fn ($field) => [(int) $field->width, (int) $field->height])
        ->toArray();
    }

    public function create_image(Request $request ,$field='image',Type $type ){
        $image = "";
        $file = $request->file($field);

        if ($request->hasFile($field)) {


            $ext = GeneralHelper::findExtension($file->getClientOriginalName());
            if (in_array($ext, $this->allowed_array)) {
            $path = public_path("post_images" );


            if($ext!='svg'){
            $filename = GeneralHelper::fixName( $type['slug']) . "_" . rand(100,90000000000) . "." . GeneralHelper::findExtension($file->getClientOriginalName());
            }else{
                $filename = $file->getClientOriginalName();
            }

            $file->move($path, $filename);
            $path = public_path("post_images"  . "/" . $filename);
                if($ext!='svg'){

                $resizedImage = Image::make($path)->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
              $resizedImage->save(public_path("post_images"   . "/icon_".$filename));
                }


                $resize_array = $this->resizeArray($type);
                if(!empty($resize_array)){
                    foreach($resize_array as $arr ){
                        $resizedImage = Image::make($path)->resize($arr[0], $arr[1], function ($constraint) {
                            $constraint->aspectRatio();
                        });
                      $resizedImage->save(public_path("post_images"   . "/".$arr[0]."x".$arr[1].$filename));
                    }
                }
            // if(false){   }

          $image = $filename;

          // }

      }

    }/// upload ,

    return $image;
}//'lang','type_id','count','title' ,'link'

}

