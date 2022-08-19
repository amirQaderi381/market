<?php

namespace App\Models\Market;

use App\Models\Market\Product;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory,SoftDeletes,Sluggable;

    protected $fillable=['persian_name','original_name','slug','logo','status','tags'];

    protected $casts=['logo'=>'array'];

    public function sluggable(): array {

        return [
            'slug' => [
                'source' => 'original_name'
            ]
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
