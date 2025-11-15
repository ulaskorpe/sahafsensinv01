<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'products';
    protected $fillable = ['title', 'icon','description','prologue'
    ,'slug','category_id','user_id','youtube_link','verified','verified_by',
    'start_price'
    ,'buy_now_price','current_price','bid_price','winner_id'];

    
    public function bids()
    {
        return $this->hasMany(\App\Models\ProductBid::class, 'product_id')->orderBy('created_at', 'desc'); 
    }
    public function images()
    {
        return $this->hasMany(\App\Models\ProductImage::class, 'product_id');
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class, 'product_id')->where('comment_id', 0);
    }
    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'keywordables', 'product_id', 'keyword_id');
    }
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    public function winner()
    {
        return $this->belongsTo(\App\Models\User::class, 'winner_id');
    }

    public function verified_by()
    {
        return $this->belongsTo(\App\Models\User::class, 'verified_by');
    }

    public function siteItems()
    {
        return $this->morphMany(SiteItem::class, 'itemable');
    }

 

 
}
