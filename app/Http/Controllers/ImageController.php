<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload($image, $location)
    {
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->storeAs($location, $imageName, 'public');
        return $imageName;
    }
}

