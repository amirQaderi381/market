<?php

namespace App\Models\Content;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes,sluggable;

    public function sluggable(): array {

        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable=['title','slug','summary','body','image','status','commentable','tags','published_at','author_id','category_id'];

    protected $casts=['image' => 'array'];

    public function postCategory()
    {
       return  $this->belongsTo(PostCategory::class,'category_id');
    }

}

