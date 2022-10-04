<?php

namespace App\Models\Market;

use App\Models\User;
use App\Models\Market\Brand;
use App\Models\Market\Comment;
use App\Models\Market\Gallery;
use Illuminate\Support\Carbon;
use App\Models\Market\Guarantee;
use App\Models\Market\AmazingSale;
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

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function activeComments()
    {
        return $this->comments()->where('approved',1)->where('parent_id',null);
    }

    public function guarantees()
    {
        return $this->hasMany(Guarantee::class);
    }

    public function amazingSales()
    {
        return $this->hasMany(AmazingSale::class);
    }

    public function activeAmazingSales()
    {
        return $this->amazingSales()->where('start_date','<',Carbon::now())->where('end_date','>',Carbon::now())->where('status',1)->first();
    }

    public function values()
    {
        return $this->hasMany(CategoryValue::class,'product_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
