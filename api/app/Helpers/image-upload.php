<?php
// app/Helpers/upload-image.php

if (!function_exists('uploadImage')) {
    function uploadImage($file, $folder)
    {
        // Generate a unique name for the image
        $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Move the uploaded image to the specified folder
        $file->move(public_path('uploads/' . $folder), $imageName);

        return $imageName;
    }
}
