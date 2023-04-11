<?php

namespace App\Helpers;

use Image;

Class ImageHelper {

    public static function store_image($image, $option = NULL){
        $name = 'post'.time().'.'.$image->getClientOriginalExtension();
        
        if(isset($option['thumbnail'])){
            $thumbnailPath = public_path('img/thumbnail');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(438, 328, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumbnailPath.'/'.$name);
        }

        $destinationPath = public_path($option['dest_path']);
        $image->move($destinationPath, $name);

        return $name;
    }
}