<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    // Show all pages
    public function index()
    {
        $defaultPages = ['home','page', 'music-tracks', 'music-videos', 'home-section-video'];
        $pages = Page::where('status', 1)
                    ->where('type', 'page')
                    ->whereNotIn('slug', $defaultPages)
                    ->get();
        return view('pages.dashboard.pages.index', compact('pages'));
    }

    // Show create form
    public function create()
    {
        $pages = Page::where('type','page')->where('status',1)->get();
        return view('pages.dashboard.pages.create', compact('pages'));
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
        $slugCount = \App\Models\Page::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = $slug . ($slugCount + 1); // append number to make it unique
        }

        // Create a new Page instance
        $page = new \App\Models\Page();
        $page->title = $request->title;
        $page->slug = $slug;
        $page->description = $request->description;
        $page->sub_description = $request->sub_description;
        $page->seo_keywords = $request->seo_keywords;
        $page->seo_description = $request->seo_description;
        $page->order = $request->order;
        $page->route_name = 'frontend.'.$slug.'';
        $page->author_id = auth()->user()->id; // Assuming you want to set the author ID to the currently authenticated user
        $page->status = ($request->has('switch_publish') && $request->switch_publish == 'on') ? 1 : 0;

        // Handle file upload for feature image
        if ($request->hasFile('file_input') && $request->file('file_input')->isValid()) {
            // Log the upload process
            \Log::info('Feature image is being uploaded');

            $filePath = 'assets/uploads/pages/';
            $file_input = $request->file('file_input');
            $filename = 'feature_img_'.$slug . '_' . time() . '.' . $file_input->getClientOriginalExtension();

            if ($file_input->move(public_path($filePath), $filename)) {
                $page->feature_image = $filename;
            } else {
                $page->feature_image = '';
                //return redirect()->route('admin.pages')->with('error', 'Sorry, there was an error uploading your file.');
            }
        } else {
            \Log::error('Feature image upload failed');
        }
        
        
        if ($request->hasFile('file_input3') && $request->file('file_input3')->isValid()) {
            // Log the upload process
            \Log::info('Banner image is being uploaded');

            $filePath3 = 'assets/frontend/img/banner/';
            $file_input3 = $request->file('file_input3');
            $filename3 = 'banner_img_'.$slug . '_' . time() . '.' . $file_input3->getClientOriginalExtension();

            if ($file_input3->move(public_path($filePath3), $filename3)) {
                $page->banner_image = $filename3;
            } else {
                $page->banner_image = 'page-bg-area-img.jpg';
                //return redirect()->route('admin.pages')->with('error', 'Sorry, there was an error uploading your file.');
            }
        } else {
            $page->banner_image = 'page-bg-area-img.jpg';
            \Log::error('Banner image upload failed');
        }

        // Save the new page to the database
        $page->save();
        Route::get('page/' . $page->slug, [\App\Http\Controllers\frontend\HomeController::class, 'dynamicPage'])->name('frontend.' . $page->slug);

        //$this->addDynamicRoute($slug);

        // Redirect or return response
        return redirect()->route('admin.pages')->with('success', 'Page created successfully');
    }

    // private function addDynamicRoute($slug)
    // {
    //     // Add the dynamic route for the page
    //     Route::get('page/' . $slug, [HomeController::class, 'dynamicPage'])->name('frontend.' . $slug);
    // }

    // Show edit form
    public function edit($id)
    {

        $page = Page::findOrFail($id);
        $pages = Page::where('type','page')->where('status',1)->get();
        return view('pages.dashboard.pages.edit', compact('page','pages'));
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
        $page = \App\Models\Page::findOrFail($id);

        // Check if the title has changed, and regenerate the slug if necessary
        $newSlug = Str::slug($request->title);
        if ($newSlug !== $page->slug) {
            // If the slug is different, check if the new slug already exists
            $slugCount = \App\Models\Page::where('slug', $newSlug)->count();
            if ($slugCount > 0) {
                $newSlug = $newSlug . '-' . ($slugCount + 1); // append number to make it unique
            }
            $page->slug = $newSlug; // Update the slug
        }

        // Update page data
        $page->title = $request->title;
        $page->sub_description = $request->sub_description; // Updated to match the input field
        $page->description = $request->description;
        $page->seo_keywords = $request->seo_keywords;
        $page->seo_description = $request->seo_description;
        $page->order = $request->order;
        $page->author_id = auth()->user()->id;
        $page->route_name = 'frontend.'.$newSlug.'';
        $page->status = $request->has('switch_publish') && $request->switch_publish == 'on' ? 1 : 0;

        // Handle file upload for feature image if provided
        //dd($request->file_input);
        if ($request->hasFile('file_input')) {
                $filePath = 'public/assets/uploads/pages/';
                if ($page->feature_image) {
                    $existingImagePath = $filePath . $page->feature_image;
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath); // Delete the old image
                    }
                }
                $filePath = 'assets/uploads/pages/';
                $file_input = $request->file('file_input');
                $filename = $newSlug . '_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $page->feature_image = $filename;
            } else {
                $page->feature_image = '';
                return redirect()->route('admin.pages')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }

        $old_video_image = $page->video_image;

        if ($request->hasFile('file_input2')) {
            $filePath = 'public/assets/uploads/images/';
            if ($old_video_image) {
                $existingImagePath = $filePath . $old_video_image;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath); // Delete the old image
                }
            }
            $filePath = 'assets/uploads/images/';
            $file_input2 = $request->file('file_input2');
            $filename = 'about_video_thumbnail_' . time() . '.' . $file_input2->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input2->move(public_path($filePath), $filename)) {
                $page->video_image = $filename;
            } else {
                $page->video_image = $old_video_image;
            }
        }

        $old_banner_image = $page->banner_image;

        if ($request->hasFile('file_input3')) {
            $filePath3 = 'public/assets/frontend/img/banner/';
            if ($old_banner_image && $old_banner_image != 'page-bg-area-img.jpg') {
                $existingImagePath = $filePath3 . $old_banner_image;
                if (file_exists($existingImagePath) && $old_banner_image != 'page-bg-area-img.jpg') {
                    unlink($existingImagePath); // Delete the old image
                }
            }
            $filePath3 = 'assets/frontend/img/banner/';
            $file_input3 = $request->file('file_input3');
            $filename3 = 'banner_image_' . time() . '.' . $file_input3->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input3->move(public_path($filePath3), $filename3)) {
                $page->banner_image = $filename3;
            } else {
                $page->banner_image = $old_banner_image;
            }
        }

        $old_video = $page->video;

        if ($request->hasFile('fileup')) {
            $filePath = 'public/assets/uploads/videos/';
            if ($old_video) {
                $existingImagePath = $filePath . $old_video;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath); // Delete the old image
                }
            }
            $filePath = 'assets/uploads/videos/';
            $file_input = $request->file('fileup');
            $filename = 'about_video_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $page->video = $filename;
            } else {
                $page->video = $old_video;
                //return redirect()->route('admin.pages')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }else{
            $page->video = $old_video;
        }

        // Save the updated page
        $page->save();

        // Redirect or return response
        return redirect()->route('admin.pages')->with('success', 'Page updated successfully');
    }


    // Delete page
    public function delete($id)
    {
        // Find the page by ID or fail if not found
        $page = Page::findOrFail($id);
        if (!$page) {
            return redirect()->route('admin.pages')->with('error', 'Page not found.');
        }

        $defaultPages = ['home', 'about-us', 'page', 'gallery', 'music-tracks', 'music-videos','home-section-video'];

        // Check if the page is a default page
        if (in_array($page->slug, $defaultPages)) {
            return redirect()->route('admin.pages')->with('error', 'You cannot delete the "' . $page->title . '" page as it is a default page.');
        }
        // If the page has a feature image, delete it from storage

        // if ($page->feature_image) {
        //     Storage::delete('public/assets/uploads/pages/' . $page->feature_image);
        // }
        if (!empty($page->feature_image) && Storage::exists('public/assets/uploads/pages/' . $page->feature_image)) {
            Storage::delete('public/assets/uploads/pages/' . $page->feature_image);
        }
        // Update the page status to 0 (inactive) instead of deleting it
        $page->status = 0;
        $page->save();

        // Redirect with success message
        return redirect()->route('admin.pages')->with('success', 'Page status updated to inactive');

    }
}
