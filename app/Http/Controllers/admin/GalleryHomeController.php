<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryHome;
use Illuminate\Support\Facades\Storage;

class GalleryHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = GalleryHome::where('status',1)->get();
        return view('pages.dashboard.gallery-home.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $image_details = [
            1 => ['width' => 445, 'height' => 373],
            2 => ['width' => 635, 'height' => 374],
            3 => ['width' => 350, 'height' => 338],
            4 => ['width' => 350, 'height' => 338],
            5 => ['width' => 350, 'height' => 338],
        ];
        $galleries = GalleryHome::findOrFail($id);
        $galleries_all = GalleryHome::all();

        // Check if the ID exists in $image_details to prevent undefined index error
        if (isset($image_details[$id])) {
            $image_width = $image_details[$id]['width'];
            $image_height = $image_details[$id]['height'];
        } else {
            // Default values if the ID is not found
            $image_width = 0;
            $image_height = 0;
        }
        $image_size = [
            'image_width' => $image_width,
            'image_height' => $image_height
        ];
        return view('pages.dashboard.gallery-home.edit', compact('galleries', 'galleries_all', 'image_size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
            'file_input' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust file input validation
        ]);

        // Find the page by ID
        $gallery_home = GalleryHome::findOrFail($id);

        // Update page data
        $gallery_home->title = $request->title;
        $gallery_home->order = $request->order;
        $gallery_home->status = $request->has('switch_publish') && $request->switch_publish == 'on' ? 1 : 0;

        // Handle file upload for feature image if provided
        //dd($request->file_input);
        if ($request->hasFile('file_input')) {
                $filePath = 'public/assets/frontend/img/gallery/';
                if ($gallery_home->image_name) {
                    $existingImagePath = $filePath . $gallery_home->image_name;
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath); // Delete the old image
                    }
                }
                $filePath = 'assets/frontend/img/gallery/';
                $file_input = $request->file('file_input');
                $filename =  'home_gallery_img__' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $gallery_home->image_name = $filename;
            } else {
                $gallery_home->image_name = '';
                return redirect()->route('admin.galleryhome')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }

        // Save the updated page
        $gallery_home->save();

        // Redirect or return response
        return redirect()->route('admin.galleryhome')->with('success', 'Page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
