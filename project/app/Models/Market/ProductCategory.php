<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
