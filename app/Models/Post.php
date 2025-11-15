<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','second_title','third_title',
    'price','discount_price',
    'content','content_2','content_3'
    ,'keywords','description'
    ,'prologue','link','count','type_id','image','second_image','third_image','forth_image','fifth_image','lang','show','show_home','parent_id','faq_id'];

    protected $table = 'posts';

    public function type()
        {
            return $this->belongsTo(Type::class);
        }

        public function parent()
        {
            // if ($this->parent_id == 0) {
            //   return null;
            // }
            return $this->belongsTo(Post::class, 'parent_id');
        }

        public function faq()
        {
            return $this->belongsTo(Post::class, 'faq_id');
        }

        // public function tags(){
        //     return $this->belongsToMany(Post::class,'blog_tag');
        // }
        /**
         * Get the child posts.
         */
        public function children()
        {
            return $this->hasMany(Post::class, 'parent_id')
            ->where('lang','=',session()->get('selectedLang'))
            ->orderBy('count');
        }

}
