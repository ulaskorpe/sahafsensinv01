<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Keyword extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'keywords';

    protected $fillable = ['name', 'slug'];

    protected static function booted(): void
    {
        static::saving(function (self $keyword) {
            if (! empty($keyword->name)) {
                $keyword->slug = Str::slug($keyword->name);
            }
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'keywordables', 'keyword_id', 'product_id');
    }

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'keywordables', 'keyword_id', 'blog_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'keywordables', 'keyword_id', 'post_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'keywordables', 'keyword_id', 'user_id');
    }
}