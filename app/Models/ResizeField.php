<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResizeField extends Model
{
    use HasFactory;
    protected $fillable = ['width','height','type_id'];

    protected $table = 'resize_fields';

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
