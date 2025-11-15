<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable = [
        'name',
        'slug',
        'fields',
        'single',
        'children',
        'active',
    ];
    /**
     * A type has many posts.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function resizeFields()
    {
        return $this->hasMany(ResizeField::class);
    }
}
