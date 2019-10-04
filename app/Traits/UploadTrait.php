<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Spatie\Image\Image;

trait UploadTrait
{
    /**
     * @param UploadedFile $file
     * @return UploadedFile
     */
    public function uploadFile(UploadedFile $file)
    {
        $file = $file->store('uploads', 'public');

        return $file;
    }

    public function resizeImage($image, $width = 100, $height = 100)
    {
        Image::load(storage_path('app/public/' . $image))
            ->width($width)
            ->height($height)
            ->save();

        return $image;
    }




}