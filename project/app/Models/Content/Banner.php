<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['title','url','image','status','position'];

    protected $casts=['image'=>'array'];

    public static $positions = [

        0   =>  'اسلاید شو (صفحه اصلی)',
        1   =>  'کنار اسلاید شو (صفحه اصلی)',
        2   =>  'دو بنر تبلیغی بین دو اسلایدر  (صفحه اصلی)',
        3   =>  'بنر تبلیغی بزرگ پایین دو اسلایدر  (صفحه اصلی)'
    ];
}
