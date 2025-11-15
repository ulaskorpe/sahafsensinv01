<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'admin_code',
        'email_verified_at','about','new_email',
        'avatar',
        'remember_token','user_code','username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
       
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function bids()
    {
        return $this->hasMany(\App\Models\ProductBid::class, 'product_id');
    }
    public function permissions() 
    {
        return $this->belongsToMany(Permission::class, 'user_permission')->withPivot('value');
    }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'keywordables', 'user_id', 'keyword_id');
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class, 'user_id');
    }

    public function addreses()
    {
        return $this->hasMany(\App\Models\UserAddress::class, 'user_id');
    }
}
