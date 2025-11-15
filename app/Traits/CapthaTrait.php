<?php 

namespace App\Traits;
use App\Models\User;
use App\Http\Controllers\Helpers\GeneralHelper;
use Intervention\Image\Facades\Image;
trait CapthaTrait{
    
    public function generateImage()
    {
        $this->deleteCaptchaFiles();
        $color = $this->generateRandomColor();
        $img = Image::canvas(180, 80, $color);
        $tcolor = $this->getComplementaryColor($color);
        // Define the text to be added
        $text = str_replace('I','$',str_replace('l','#', GeneralHelper::randomPassword(6,1)));
        
        // Add text to the image
        $img->text($text, 80, 30, function($font) use ($tcolor) {
            $font->file(public_path('fonts/Arial.ttf'));  
            $font->size(35);
            $font->color($tcolor);
            $font->align('center');
            $font->valign('middle');
        });

        // // Save the image to storage or return it directly
        $imgname = date('Ymdhis').rand(1000,5000);
         $img->save(public_path('files/captha/'.$imgname.'.png'));

        // // Return the image directly to the browser
        // return $img->response('png');
            return ['img'=> $imgname.".png", 'text'=>$text];
       
    }




    public function deleteCaptchaFiles()
    {
         
        $directory = public_path('files/captha/');
 
        $files = glob($directory . '*');  

         
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file); // Delete the file
            }
        }

        // Return a response indicating success
        // return response()->json(['message' => 'All files have been deleted.']);
    }

    public function generateRandomColor() {
        
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);
    
        return [$r, $g, $b];
    }
    
     
    public function getComplementaryColor($color) {
        list($r, $g, $b) = $color;
    
        // Calculate the complementary color
        $compR = 255 - $r;
        $compG = 255 - $g;
        $compB = 255 - $b;
    
        return [$compR, $compG, $compB];
    }

}