<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $fillable = ['name_surname','phone','email','message','is_read','treatment_id','reply_text','reply_subject'];




    public function treatment()
    {
        return $this->belongsTo(Post::class, 'treatment_id');
    }

}
