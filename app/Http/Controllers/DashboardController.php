<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
 
use App\Models\User;
use App\Models\Permission;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Session;
  use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;
class DashboardController extends Controller
{

    public function __construct()
    {
        //    $this->middleware('checkAdmin');
     
    }

     public function index(){
    //    $permissions = Permission::all();

    //     foreach($permissions as $p){
    //         $user->permissions()->attach($p['id'], ['value' => 3]); 
    //         echo $p['slug'];
    //     }
    //     die();
        return view('admin.index',['type'=>'dashboard']);
     }
}
