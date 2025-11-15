<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSetting extends Model
{
    use HasFactory,SoftDeletes;

    protected $connection  = 'mysql';
    protected $table = 'user_settings';
    protected $fillable = [
        'user_id',
        'receive_messages',
        'friendship_allow',
        'receive_emails',
        'bid_inform',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
