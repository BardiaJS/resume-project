<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Storage;
use function Symfony\Component\String\b;

class ImageController extends Controller
{
    //
    // View File To Upload Image
    public function index()
    {
        return view('image-form');
    }

    // Store Image
    public function storeImage(Request $request , User $user)
    {
        $request->validate([
            'avatar' => 'required|image|max:3000'
        ]); 
        $fileName = $user->id . '-' . uniqid() . '.jpg';
        $imgData = Image::make($request->file('avatar'))->fit(120)->encode('jpg');
        Storage::put('publlic/avatars/' . $fileName , $imgData);
        $user->avatar = $fileName;
        $user->save();
    }
}
