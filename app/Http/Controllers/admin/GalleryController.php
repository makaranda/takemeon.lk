<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        $defaultPages = ['home','page', 'music-tracks', 'music-videos', 'home-section-video'];
        $galleries_group = Gallery::where('status', 1)->orderByDesc('year')->get()->unique('year')->values();
        /*$pages = Gallery::where('status', 1)
                    ->whereNotIn('slug', $defaultPages)
                    ->get();*/
        $pages = Gallery::orderBy('year', 'desc')->get()->groupBy('year');            
        return view('pages.dashboard.gallery.index', compact('pages','galleries_group'));
        //dd($pages);
    }
    
    public function eventItems(){
        //if(is_null($id)){
            $pages = GalleryItem::where('status', 1)
                    ->get();
        /*}else{
            $pages = GalleryItem::where('status', 1)
                    ->where('gallery_id', $id)
                    ->get();
        } */           
        return view('pages.dashboard.gallery.gallery_items', compact('pages'));
    }

    // Show create form
    public function create()
    {
        $pages = Gallery::all();
        return view('pages.dashboard.gallery.create', compact('pages'));
    }

    // Store new page
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sub_description' => 'nullable|string',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        // Generate slug from the title
        $slug = Str::slug($request->title);

        // Check if the slug exists, if so, add a number to make it unique
        $slugCount = \App\Models\Gallery::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = $slug . ($slugCount + 1); // append number to make it unique
        }

        // Create a new Page instance
        $gallery = new \App\Models\Gallery();
        $gallery->title = $request->title;
        $gallery->slug = $slug;
        $gallery->description = $request->description;
        $gallery->sub_description = $request->sub_description;
        $gallery->seo_keywords = $request->seo_keywords;
        $gallery->seo_description = $request->seo_description;
        $gallery->order = $request->order;
        $gallery->year = $request->year ?? date('Y');
        $gallery->route_name = 'frontend.'.$slug.'';
        $gallery->author_id = auth()->user()->id; // Assuming you want to set the author ID to the currently authenticated user
        $gallery->status = ($request->has('switch_publish') && $request->switch_publish == 'on') ? 1 : 0;

        // Handle file upload for feature image
        if ($request->hasFile('file_input') && $request->file('file_input')->isValid()) {
            // Log the upload process
            \Log::info('Feature image is being uploaded');

            $filePath = 'assets/uploads/gallery/';
            $file_input = $request->file('file_input');
            $filename = $slug . '_' . time() . '.' . $file_input->getClientOriginalExtension();

            if ($file_input->move(public_path($filePath), $filename)) {
                $gallery->feature_image = $filename;
            } else {
                $gallery->feature_image = '';
                //return redirect()->route('admin.events')->with('error', 'Sorry, there was an error uploading your file.');
            }
        } else {
            $gallery->feature_image = '';
            \Log::error('Feature image upload failed');
        }


        if ($request->hasFile('file_input2') && $request->file('file_input2')->isValid()) {
            // Log the upload process
            $filePath2 = 'assets/frontend/img/banner/';
            $file_input2 = $request->file('file_input2');
            $filename2 = 'banner_img_'.$slug . '_' . time() . '.' . $file_input2->getClientOriginalExtension();

            if ($file_input2->move(public_path($filePath2), $filename2)) {
                $gallery->banner_image = $filename2;
            } else {
                $gallery->banner_image = 'page-bg-area-img.jpg';
                //return redirect()->route('admin.pages')->with('error', 'Sorry, there was an error uploading your file.');
            }
        } else {
            $gallery->banner_image = 'page-bg-area-img.jpg';
        }

        // Save the new page to the database
        $gallery->save();
        Route::get('gallery/' . $gallery->slug, [\App\Http\Controllers\frontend\HomeController::class, 'dynamicPage'])->name('frontend.' . $gallery->slug);

        //$this->addDynamicRoute($slug);

        // Redirect or return response
        return redirect()->route('admin.events')->with('success', 'Event created successfully');
    }

    // private function addDynamicRoute($slug)
    // {
    //     // Add the dynamic route for the page
    //     Route::get('gallery/' . $slug, [HomeController::class, 'dynamicPage'])->name('frontend.' . $slug);
    // }

    // Show edit form
    public function edit($id)
    {

        $page = Gallery::findOrFail($id);
        $pages = Gallery::all();
        return view('pages.dashboard.gallery.edit', compact('page','pages'));
    }

    // Update page
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_description' => 'nullable|string', // Make sure to update this to 'short_description'
            'description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
            'file_input' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust file input validation
        ]);

        // Find the page by ID
        $gallery = \App\Models\Gallery::findOrFail($id);

        // Check if the title has changed, and regenerate the slug if necessary
        $newSlug = Str::slug($request->title);
        if ($newSlug !== $gallery->slug) {
            // If the slug is different, check if the new slug already exists
            $slugCount = \App\Models\Gallery::where('slug', $newSlug)->count();
            if ($slugCount > 0) {
                $newSlug = $newSlug . '-' . ($slugCount + 1); // append number to make it unique
            }
            $gallery->slug = $newSlug; // Update the slug
        }

        // Update page data
        $gallery->title = $request->title;
        $gallery->sub_description = $request->sub_description; // Updated to match the input field
        $gallery->description = $request->description;
        $gallery->seo_keywords = $request->seo_keywords;
        $gallery->seo_description = $request->seo_description;
        $gallery->order = $request->order;
        $gallery->year = $request->year;
        $gallery->author_id = auth()->user()->id;
        $gallery->route_name = 'frontend.'.$newSlug.'';
        $gallery->status = $request->has('switch_publish') && $request->switch_publish == 'on' ? 1 : 0;

        // Handle file upload for feature image if provided
        //dd($request->file_input);
        if ($request->hasFile('file_input')) {
                $filePath = 'public/assets/uploads/gallery/';
                if ($gallery->feature_image) {
                    $existingImagePath = $filePath . $gallery->feature_image;
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath); // Delete the old image
                    }
                }
                $filePath = 'assets/uploads/gallery/';
                $file_input = $request->file('file_input');
                $filename = $newSlug . '_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $gallery->feature_image = $filename;
            } else {
                $gallery->feature_image = '';
                return redirect()->route('admin.events')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }

        $old_banner_image = $gallery->banner_image;

        if ($request->hasFile('file_input2')) {
            $filePath2 = 'public/assets/frontend/img/banner/';
            if ($old_banner_image && $old_banner_image != 'page-bg-area-img.jpg') {
                $existingImagePath = $filePath2 . $old_banner_image;
                if (file_exists($existingImagePath) && $old_banner_image != 'page-bg-area-img.jpg') {
                    unlink($existingImagePath); // Delete the old image
                }
            }
            $filePath2 = 'assets/frontend/img/banner/';
            $file_input2 = $request->file('file_input2');
            $filename2 = 'banner_image_' . time() . '.' . $file_input2->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input2->move(public_path($filePath2), $filename2)) {
                $gallery->banner_image = $filename2;
            } else {
                $gallery->banner_image = $old_banner_image;
            }
        }

        // Save the updated page
        $gallery->save();

        // Redirect or return response
        return redirect()->route('admin.events')->with('success', 'Event updated successfully');
    }


    // Delete page
    public function delete($id)
    {
        // Find the page by ID or fail if not found
        $gallery = Gallery::findOrFail($id);
        if (!$page) {
            return redirect()->route('admin.events')->with('error', 'Page not found.');
        }

        $defaultPages = ['home', 'about-us', 'page', 'gallery', 'music-tracks', 'music-videos','home-section-video'];

        // Check if the page is a default page
        if (in_array($gallery->slug, $defaultPages)) {
            return redirect()->route('admin.events')->with('error', 'You cannot delete the "' . $gallery->title . '" page as it is a default page.');
        }
        // If the page has a feature image, delete it from storage

        // if ($gallery->feature_image) {
        //     Storage::delete('public/assets/uploads/pages/' . $gallery->feature_image);
        // }
        if (!empty($gallery->feature_image) && Storage::exists('public/assets/uploads/pages/' . $gallery->feature_image)) {
            Storage::delete('public/assets/uploads/pages/' . $gallery->feature_image);
        }
        // Update the page status to 0 (inactive) instead of deleting it
        $gallery->status = 0;
        $gallery->save();

        // Redirect with success message
        return redirect()->route('admin.events')->with('success', 'Event status updated to inactive');

    }
}
