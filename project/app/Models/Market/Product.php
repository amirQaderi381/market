<?php

namespace App\Models\Market;

use App\Models\Market\Brand;
use App\Models\Market\Gallery;
use App\Models\Market\ProductMeta;
use App\Models\Market\ProductColor;
use App\Models\Market\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,SoftDeletes,Sluggable;

    protected $fillable=['name','introduction','slug','image','weight','length','width','height',
    'price','status','marketable','tags','sold_number','frozen_number','marketable_number',
    'brand_id','category_id','published_at'];

    protected $casts=['image'=>'array'];

    public function sluggable(): array
    {
        return [

            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }

    public function metas()
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function images()
    {
        return $this->hasMany(Gallery::class);
    }
}
