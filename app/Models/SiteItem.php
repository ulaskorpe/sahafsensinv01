<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteItem extends Model
{
    use HasFactory;


    protected $fillable = ['item_id', 'source','type','valid_until','rank'];

    public function itemable()
    {
        return $this->morphTo();
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (!in_array($model->source, ['App\Models\Product', 'App\Models\Blog'])) {
                throw new \InvalidArgumentException("Invalid type: {$model->source}");
            }

            $relatedModel = app($model->source)::find($model->item_id);
            if (!$relatedModel) {
                throw new \InvalidArgumentException("Invalid item_id: {$model->item_id} for type: {$model->source}");
            }
        });
    }
}
