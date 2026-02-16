<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CKEditorController extends Controller
{
   public function upload(Request $request)
{
    // if ($request->hasFile('upload')) {
    //     $file = $request->file('upload');
    //     $filename = time() . '_' . $file->getClientOriginalName();
    //     $path = $file->storeAs('public/assets/uploads/', $filename);

    //     $url = Storage::url($path);

    //     return response()->json([
    //         'uploaded' => 1,
    //         'fileName' => $filename,
    //         'url' => $url,
    //     ]);
    // }

    if ($request->hasFile('upload')) {
        $uploadPath = 'assets/uploads/';
        $file = $request->file('upload');
        $filename = 'ckgallery_' . time() . '.' . $file->getClientOriginalExtension();

        if ($file->move(public_path($uploadPath), $filename)) {
            $url = asset($uploadPath . $filename); // public URL for CKEditor

            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => $url
            ]);
        }
    }

    return response()->json([
        'uploaded' => 0,
        'error' => ['message' => 'Image upload failed.']
    ]);
}
}
