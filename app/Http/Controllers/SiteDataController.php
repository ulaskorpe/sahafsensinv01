<?php

namespace App\Http\Controllers;
use App\Contracts\CrudControllerInterface;
use App\Models\SiteData;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

use Exception;
class SiteDataController extends Controller implements CrudControllerInterface
{
    use HttpResponses;

    public function index()
    {
        $site_data =SiteData::orderBy('title')->get();
         

        return view('admin.panel.site_data.index',['site_data'=>$site_data]);
    }

    public function create(){
        return view('admin.panel.site_data.create');
    }
    public function store(Request $request){

        try{
            
       
            SiteData::create([
                'title'=>$request['title'],
                'key'=>$request['slug'],
                'value'=>$request['value'],
                
            ]);

            return  $this->success([''],"Site Verisi Eklendi" ,201);
        }catch (Exception $e){
         
            return  $this->error([''], $e->getMessage() ,500);
        } 

    }
    public function show($id){}
    public function edit($id){
        $data = SiteData::find($id);
        
 
        return view('admin.panel.site_data.update',['data'=>$data]);

    }
    public function update(Request $request ){


        try{
            $data = SiteData::find($request['id']);
            $data->title = $request['title'];
            $data->key = $request['slug'];
            $data->value = $request['value'];
            $data->save();
         
          return  $this->success([''],"Veri Güncellendi" ,200);
        }catch (Exception $e){
           // return response()->json(['error' => $e->getMessage()], 500);
            return  $this->error([''], $e->getMessage() ,500);
        } 

    }
    public function destroy(Request $request){}
    public function check_slug($key,$id=0 ){

        $ch = SiteData::where('key','=',$key)->where('id','<>',$id) ->first();
        if($ch){
            return response()->json('bu isimde başka bir veri mevcut');
        }
       
    return response()->json("ok");
    }
}
