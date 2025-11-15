<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserCode extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'user_codes';
    protected $fillable = ['user_id','code','valid_until'];

    public function user(){
        return $this->hasOne(User::class,'user_id');
    }
}
