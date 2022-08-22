<?php

namespace App\Models\Market;

use App\Models\Market\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\Market\CategoryAttribute;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory,SoftDeletes,Sluggable;

    protected $fillable=['name','description','slug','image','status','show_in_menu','tags','parent_id'];

    protected $casts=['image' => 'array'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function parent()
    {
        return $this->belongsTo($this,'parent_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany($this,'parent_id')->with('children');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function attributes()
    {
        return $this->hasMany(CategoryAttribute::class);
    }
}
