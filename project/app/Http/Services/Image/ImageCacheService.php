<?php

namespace App\Http\Services\Image;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;

class ImageCacheService
{


    public function cache($imagePath , $size='')
    {
        // set image size

        $imageSizes = Config::get('image.cache_image_sizes');

        if(!isset($imageSizes[$size]))
        {
            $size = Config::get('image.default_current_cache_image');
        }

        $width = $imageSizes[$size]['width'];
        $height = $imageSizes[$size]['height'];

        // cache image

        if(file_exists($imagePath))
        {
            $img = Image::cache(function($image) use ($imagePath , $width ,$height){
                return $image->make($imagePath)->fit($width , $height);
            },Config::get('image.image-cache-life-time'),true);
            return $img->response();

        }else{

            $img = Image::canvas($width,$height,'#cdcdcd')->text('image not found-404',$width/2,$height/2,function($font){

                $font->color('#333333');
                $font->align('center');
                $font->valign('center');
                $font->file(public_path('admin_assets/fonts/vazir/vazir.woff'));
                $font->size(24);
            });

            return $img->response();
        }
    }


}
