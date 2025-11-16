<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Models\Type as Type;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Http\Controllers\Helpers\GeneralHelper;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Mail\AdminCreatedMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
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
            $ch = User::where('email','=',$email)
            ->whereIn('role_id',[1,2,3])
            ->where('id','<>',$user['id'])->first();
            if($ch){
                return response()->json('bu email adresi ile başka bir admin kayıtlı');
            }
        } else {
           return response()->json("geçersiz email adresi");
        }
        return response()->json("ok");
    }


    public function check_phone($phone){
        
            $user = User::where('admin_code','=',Session::get('admin_code'))->first();
            $ch = User::where('phone_number','=',$phone)->where('id','<>',$user['id'])
            ->whereIn('role_id',[1,2,3])
            ->first();
            if($ch){
                return response()->json('bu telefon ile başka bir admin kayıtlı');
            }
     
        return response()->json("ok");
    }

    public function profile(){
        $type = Type::where('slug','=','top_banner')->first();
        //dd(User::where('admin_code','=',Session::get('admin_code'))->first());
            return view('admin_panel.profile',['type'=>$type,'user'=> User::where('admin_code','=',Session::get('admin_code'))->first()]);
    }

    public function profile_post(Request $request){


        try{
            $user = User::where('admin_code','=',Session::get('admin_code'))->first();
            $user->email= $request['email'];
            $user->name= $request['name'];
            $user->phone_number= $request['phone'];
   
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

    public function adminList(): View
    {
        $admins = User::where('role_id', 2)
            ->orderByDesc('id')
            ->get();

        return view('admin_panel.admins.admin_list', [
            'admins' => $admins,'type'=>Type::find(58)
        ]);
    }

    public function adminCreate(): View
    {
        return view('admin_panel.admins.admin_form', [
            'admin' => new User(),
            'type'=>Type::find(58),
            'formAction' => route('sudo.admin-post'),
            'isEdit' => false,
        ]);
    }

    public function adminEdit(User $admin): View
    {
        if ((int) $admin->role_id !== 2) {
            abort(404);
        }

        return view('admin_panel.admins.admin_form', [
            'admin' => $admin,
            'formAction' => route('sudo.admin-post'),
            'isEdit' => true,
        ]);
    }

    public function adminPost(Request $request): RedirectResponse
    {
        $adminId = (int) $request->input('id');
        $admin = null;

        if ($adminId > 0) {
            $admin = User::findOrFail($adminId);

            if ((int) $admin->role_id !== 2) {
                abort(404);
            }
        }

        $validator = Validator::make($request->all(), [
            'id' => ['nullable', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($admin?->id),
            ],
            'phone_number' => ['nullable', 'string', 'max:255'],
          //  'password' => [$admin ? 'nullable' : 'required', 'string', 'min:6'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ]);
            }

            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();


        $pw = GeneralHelper::randomPassword(8,1);


        $admin ??= new User();

        $admin->name = trim($validated['name']);
        $admin->email = strtolower(trim($validated['email']));
        $admin->phone_number = isset($validated['phone_number']) ? trim((string) $validated['phone_number']) : null;
        $admin->role_id = 2;

       
        if (!$admin->exists) {
            $admin->admin_code = $this->generateAdminCode();
        }

        if (!empty($plainPassword)) {
            $admin->password = $pw;
        }

        if (!$admin->exists) {
            $admin->email_verified_at = now();
        }

        try {
            $admin->save();

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $path = public_path('files/users/' . $admin->id);
                File::ensureDirectoryExists($path);

                $filename = GeneralHelper::fixName($admin->name) . '_' . now()->format('YmdHis') . '.' . GeneralHelper::findExtension($file->getClientOriginalName());
                $file->move($path, $filename);

                $admin->avatar = $filename;
                $imagePath = $path . '/' . $filename;
                $resizedImage = Image::make($imagePath)->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $resizedImage->save($path . '/200' . $filename);

                $admin->save();
            }

            if (!$adminId && $pw) {
                try {
                    Mail::to($admin->email)->send(new AdminCreatedMail($admin->name, $admin->admin_code, $plainPassword));
                } catch (Exception $exception) {
                    report($exception);
                }
            }
        } catch (Exception $exception) {
            report($exception);

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('Beklenmeyen bir hata oluştu.'),
                ], 500);
            }
            return redirect()
            ->back()
            ->with('error', __('Beklenmeyen bir hata oluştu.'));
        }

        $message = $adminId ? __('Yönetici başarıyla güncellendi.') : __('Yönetici başarıyla oluşturuldu.');
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
            ]);
        }
        return redirect()
            ->route('sudo.admin-list')
            ->with('success', $message);
    }

    public function adminDelete(User $admin): RedirectResponse
    {
        if ((int) $admin->role_id !== 2) {
            abort(404);
        }

        if ($admin->id === Auth::id()) {
            return redirect()
                ->route('sudo.admin-list')
                ->with('error', __('Kendi hesabınızı silemezsiniz.'));
        }

        $admin->delete();

        return redirect()
            ->route('sudo.admin-list')
            ->with('success', __('Yönetici başarıyla silindi.'));
    }

    //TODO :: make admin crud
    private function generateAdminCode(): int
    {
        do {
            $token = random_int(100000, 999999);
            $exists = User::where('admin_code', $token)->exists();
        } while ($exists);

        return $token;
    }
}

