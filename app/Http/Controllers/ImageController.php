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
        $id = $user->id;

            $requestData = $request->validate([
                'avatar' => 'required|image|max:3000'
               ]);
                $filName = time().$request->file('avatar')->getClientOriginalName();
                $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                $requestData ["avatar"] = '/storage/'. $path;
                $user->avatar = $requestData['avatar'];
                $user->save();
                return back()->with('success' , 'image successfully uploaded!');
        

    }

    public function indexEdit()
    {
        return view('image-form-edit');
    }

    // Store Image
    public function storeImageEdit(Request $request , User $user)
    {
            $id = $user->id;

            $requestData = $request->validate([
                'avatar' => 'required|image|max:3000'
               ]);
                $filName = time().$request->file('avatar')->getClientOriginalName();
                $path = $request->file('avatar')->storeAs('avatars' , $filName , 'public');
                $requestData ["avatar"] = '/storage/'. $path;
                $user->avatar = $requestData['avatar'];
                $user->update();
        

    }
}
