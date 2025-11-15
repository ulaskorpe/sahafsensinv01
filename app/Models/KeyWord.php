<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeyWord extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'keywords';
    protected $fillable = ['name','slug'];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'keywordables', 'keyword_id', 'product_id');
    }

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'keywordables', 'keyword_id', 'blog_id');
    }
}
