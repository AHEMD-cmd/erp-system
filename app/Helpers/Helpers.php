<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

if (!function_exists('upload_image')) {
    function upload_image(UploadedFile $image, string $path = 'images'): string
    {
        return $image->store($path, 'public');
    }
}
