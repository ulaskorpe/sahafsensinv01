<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Exception;
use App\Http\Controllers\Helpers\GeneralHelper;
use Intervention\Image\Facades\Image;
class AdminController extends Controller
{
    use HttpResponses;

    public function __construct(){
       
    }
    private $allowed_array = ['jpg', 'jpeg','png'];

    public function check_old_pw($old_pw){
        // $user = Auth::user();
        // $user->password=Hash::make('123123');
        // $user->save();
        $user = User::where('admin_code','=',Session::get('admin_code'))->first();
        if(!Hash::check( $old_pw, $user['password'])){
            return response()->json('eski şifrenizi hatalı girdiniz');
        }

        return response()->json("ok");
    }

    public function check_email($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('admin_code','=',Session::get('admin_code'))->first();
            $ch = User::where('email','=',$email)->where('id','<>',$user['id'])->first();
            if($ch){
                return response()->json('bu email adresi ile başka kullanıcı kayıtlı');
            }
        } else {
           return response()->json("geçersiz email adresi");
        }
        return response()->json("ok");
    }

    public function profile(){
        
            return view('admin.panel.profile',['user'=> User::where('admin_code','=',Session::get('admin_code'))->first()]);
    }

    public function profile_post(Request $request){


        try{
            $user = User::where('admin_code','=',Session::get('admin_code'))->first();
            $user->email= $request['email'];
            $user->name= $request['name'];
            $user->phone_number= $request['phone_number'];
   
         if(!empty($request->hasFile('avatar'))){
            $file = $request->file('avatar');
            $ext = GeneralHelper::findExtension($file->getClientOriginalName());
            if (in_array($ext, $this->allowed_array)) {
         
                if (!empty($file)) {
                    $path = public_path("files/users/" . $user['id']);
                    $filename = GeneralHelper::fixName($request['name']) . "_" . date('YmdHis') . "." . GeneralHelper::findExtension($file->getClientOriginalName());
                    $file->move($path, $filename);
                    $user->avatar = $filename;
   
               
   
                $path = public_path("files/users/" . $user['id'] . "/" . $filename);
   
    
                   $resizedImage = Image::make($path)->resize(200, null, function ($constraint) {
                       $constraint->aspectRatio();
                   });
   
    
               $resizedImage->save(public_path("files/users/" . $user['id'] . "/200".$filename));
                   }
   
            }
        }
   
            $user->save();

            return  $this->success([''],"Bilgileriniz güncellendi" ,200);
         }catch (Exception $e){
            // return response()->json(['error' => $e->getMessage()], 500);
             return  $this->error([''], $e->getMessage() ,500);
         }

      
        
        
    }

    public function password_post(Request $request){
        $user = User::where('admin_code','=',Session::get('admin_code'))->first();
        $user->password= Hash::make($request['password']);
  
        $user->save();
       
       return  $this->success([''],"Şifreniz güncellendi" ,200);
    }

    public function notifications(){
        
    }

    public function admin_settings(){
        
    }
}

