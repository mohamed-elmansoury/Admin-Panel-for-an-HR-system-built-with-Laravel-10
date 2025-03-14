<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('photo')->store('public/photos');

        $photo = new Photo();
        $photo->path = $path;
        $photo->save();

        return back()->with('success', 'Photo uploaded successfully.')->with('path', $path);
    }
}
