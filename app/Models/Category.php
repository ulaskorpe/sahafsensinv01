<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name', 'icon','description','rank','slug','parent_id','type'];

 
    public function subcategory()
    {
        return $this->hasMany(\App\Models\Category::class, 'parent_id')->orderBy('rank');
    }
    
    public function images()
    {
        return $this->hasMany(\App\Models\CategoryImage::class, 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public static function getParentTree($categoryId)
    {
        $category = self::find($categoryId);

        if (!$category) {
            return null;
        }

        $parentTree = [];
        self::fetchParents($category, $parentTree);

        return collect( array_reverse( $parentTree));
    }
    private static function fetchParents($category, &$parentTree)
    {
        // Add the current category to the parent tree
        $parentTree[] = $category;

        // If the category has a parent, recursively fetch the parent
        if ($category->parent) {
            self::fetchParents($category->parent, $parentTree);
        }
    }

    public function parentTree()
    {
        return self::getParentTree($this->id);
    }
    
}
