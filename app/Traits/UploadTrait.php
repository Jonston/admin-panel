<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Spatie\Image\Image;

trait UploadTrait
{
    /**
     * @param UploadedFile $uploadedFile
     * @param null $filename
     * @return false|string
     */
    public function uploadFile(UploadedFile $uploadedFile, $filename = null)
    {
        $name = ! is_null($filename) ? $filename : Str::random(25);

        $today = today();

        $folder = '/uploads/' . $today->year . '/' . $today->month . '/';

        $file = $uploadedFile->storeAs(
            $folder,
            $name . '.' . $uploadedFile->getClientOriginalExtension(),
            'public'
        );

        return $file;
    }

    public function resizeImage($image, $width = 100, $height = 100)
    {
        $image = Image::load($image)
            ->width($width)
            ->height($height)
            ->save();

        return $image;
    }




}