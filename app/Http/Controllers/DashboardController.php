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
use App\Models\Counter;
use App\Models\Type as Type;
class DashboardController extends Controller
{

    public function __construct()
    {
         $this->middleware('checkAdmin');
     
    }

    public function index( $type= 'menu_item' ){

       
      $dailyData = Counter::selectRaw('date, COUNT(DISTINCT ip_address) as unique_ips, SUM(count) as total_visits')
      ->groupBy('date')
      ->orderBy('date')
      ->get();


      $countryData = Counter::selectRaw('country, SUM(count) as total_visits')
      ->groupBy('country')
      ->orderByDesc('total_visits')
      ->get();

      $type = Type::where('slug','=',$type)->first();
      if(empty($type)){
          $type = Type::where('slug','=','top_banner')->first();
      }

      return view('admin_panel.index',['type'=>$type, 'dailyData' => $dailyData,
      'countryData' => $countryData,]);
     }
}
