<?php

namespace App\Observers;

use App\Mail\UserCreatedEmail;
use App\Mail\UserEmailUpdate;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
class UserObserver
{
    public function created(User $user){

        $permissions = Permission::select('id')->whereIn('slug',['product','blog'])->get();
            $txt= "";
            foreach($permissions as $p){
                 $user->permissions()->attach($p['id'], ['value' => 3]); 
                $txt.=$p['id'];
            }
        //Log::channel('data_check')->info($user->email.":".$txt);
                $link = url('/confirm/'.$user['remember_token']);
     
            Mail::to($user['email'])->send(new UserCreatedEmail($user['name'],$link,$user['user_code']));
    }


    public function saved(User $user){
            if($user->isDirty('new_email')){
                if($user['new_email']!=null){
                $link = url('/eposta-guncelleme/'.$user['remember_token']);
     
                Mail::to($user['new_email'])->send(new UserEmailUpdate($user['name'],$link));
                }
            }
    }
}
