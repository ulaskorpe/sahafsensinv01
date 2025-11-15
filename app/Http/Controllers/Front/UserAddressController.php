<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Neighborhood;
use App\Models\Town;
use App\Models\UserAddress;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Support\Facades\Session; 
class UserAddressController extends Controller
{

    
    use HttpResponses;
    // /private $user_id;
    public function __construct(){
        
    }

    public function delete_address($id){
        $addr = UserAddress::find($id);
            if($addr['selected']){
                $new = UserAddress::where('user_id','=',$this->user_id())->where('id','<>',$id)->first();
                if(empty($new['id'])){
                    return response()->json("Birincil adresinizi silemezsiniz!");
                }
                $new->selected = 1;
                 $new->save();
            
            }
            $addr->delete();
        

        return response()->json("ok");
    }
    public function make_primary($id){
        $addr = UserAddress::find($id);

       
        UserAddress::where('user_id','=',$this->user_id())->update(['selected'=>0]);
        $addr->selected=1;
        $addr->save();

        return response()->json("ok");
    }

    public function user_address_post(Request $request){
        try{
           $count = UserAddress::where('user_id','=',$this->user_id())->count();
            if($request['address_id']==0){
                $addr = new UserAddress();
                $addr->user_id= $this->user_id();
                    $msg ="Yeni adresiniz eklendi";
            }else{
                $addr = UserAddress::find($request['address_id']);
                $msg ="Adresiniz güncellendi";

                if($addr['selected']==1 && empty($request['selected'])){
                    $count = 0;
                }
            }

            $addr->name= $request['address_name'];
            $addr->type= $request['type'];
            $addr->city_id= $request['city_id'];
            $addr->town_id= $request['town_id'];
            $addr->district_id= $request['district_id'];
            $addr->neighborhood_id= $request['neighborhood_id'];
            $addr->address= $request['address_text'];
            if($count==0){
                $addr->selected= 1;
            }else{
                    $addr->selected= (!empty($request['selected']))?1:0;
                  //  UserAddress::where('user_id','=',$this->user_id())->update(['selected','=',$this->user_id()]);
                
           
            }
            
            $addr->save();
            
            if(!empty($request['selected'])){
                UserAddress::where('user_id','=',$this->user_id())->where('id','<>',$addr['id'])->update(['selected'=>0]);
            }
 
             return  $this->success([''],$msg ,201);
         }catch (Exception $e){
            // return response()->json(['error' => $e->getMessage()], 500);
             return  $this->error([''], $e->getMessage() ,500);
         } 

    }

    public function address_form($id=0){
        
        $address_id= ($id!='undefined')?$id:0;
        if($address_id>0){
            $address = UserAddress::where('user_id','=',$this->user_id())->where('id','=',$address_id)->first();
            
            $name = $address['name'];
            $type = $address['type'];
            $city_id = $address['city_id'];
            $town_id = $address['town_id'];
            $district_id = $address['district_id'];
            $neighborhood_id = $address['neighborhood_id'];
            $address_text = $address['address'];
            $selected = $address['selected'];
                $exe = 'Güncelle';
        }else{

            $type = "";
            $name = "";
            $city_id = 0;
            $town_id = 0;
            $district_id = 0;
            $neighborhood_id = 0;
            $address_text = "";
            $selected = 0;
            $exe = 'Ekle';
        }
        
        $cities =City::orderBy('name')->get();
        return view('front.partials.address_form', compact('cities','exe','type','name','city_id','town_id','district_id','neighborhood_id','address_text','selected','address_id'));
    }


    public function town_select($city_id){
        return response()->json(Town::where('city_id','=',$city_id)->orderBy('name')->get());
    }
    public function district_select($town_id){
        return response()->json(District::where('town_id','=',$town_id)->orderBy('name')->get());
    }

    public function neighborhood_select($district_id){
        return response()->json(Neighborhood::where('district_id','=',$district_id)->orderBy('name')->get());
    }
    private function user_id(){
        $user = User::select('id')->where('user_code','=',Session::get('user_code'))->first();
        return $user['id'];
    }

    public function user_addresses(){

        // $user_id = $this->user_id();
        // if($selected!=0){
        //     UserAddress::where('user_id', $user_id )->update([
        //         'selected' => 0,
        //     ]);
        
        //     UserAddress::where('user_id', $user_id )->where('id','=',$selected)->update([
        //         'selected' => 0,
        //     ]);

        // }

        return view('front.partials.my_addresses',['addresses'=>UserAddress::with('neighborhood','district','town','city')->where('user_id','=',$this->user_id() )
        ->orderBy('selected','DESC')->get(),'type_array'=>['home'=>'Ev','work'=>'İş','other'=>'Diğer']]);
    }
}
