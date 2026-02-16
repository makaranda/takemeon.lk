<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Country;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudyAbroadController extends Controller
{
    // Show all pages
    public function index()
    {
        $defaultPages = ['home','page', 'music-tracks', 'music-videos', 'home-section-video'];
        $pages = Page::where('status', 1)
                    ->where('type', 'study_abroad')
                    ->whereNotIn('slug', $defaultPages)
                    ->get();
        return view('pages.dashboard.page-study-abroad.index', compact('pages'));
    }

    // Show create form
    public function create()
    {
        $pages = Page::all();
        $countries = Country::where('status', 1)->get();
        return view('pages.dashboard.page-study-abroad.create', compact('pages', 'countries'));
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
        $page->type = 'study_abroad'; // Set the type to 'study_abroad'
        $page->route_name = 'frontend.'.$slug.'';
        $page->author_id = auth()->user()->id; // Assuming you want to set the author ID to the currently authenticated user
        $page->status = ($request->has('switch_publish') && $request->switch_publish == 'on') ? 1 : 0;
        $page->attributes = [
            'type' => '',
            'country' => $request->country ?? null,
        ];

        // Handle file upload for feature image
        if ($request->hasFile('file_input') && $request->file('file_input')->isValid()) {
            // Log the upload process
            \Log::info('Feature image is being uploaded');

            $filePath = 'assets/uploads/pages/';
            $file_input = $request->file('file_input');
            $filename = $slug . '_' . time() . '.' . $file_input->getClientOriginalExtension();

            if ($file_input->move(public_path($filePath), $filename)) {
                $page->feature_image = $filename;
            } else {
                $page->feature_image = '';
                //return redirect()->route('admin.studyabroad')->with('error', 'Sorry, there was an error uploading your file.');
            }
        } else {
            \Log::error('Feature image upload failed');
        }

        if ($request->hasFile('file_input2')) {
                $filePath = 'public/assets/uploads/pages/';

                $filePath = 'assets/uploads/pages/';
                $file_input2 = $request->file('file_input2');
                $filename = $slug . '_' . time() . '.' . $file_input2->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input2->move(public_path($filePath), $filename)) {
                $page->banner_image = $filename;
            } else {
                $page->banner_image = 'page-bg-area-img.jpg';
                return redirect()->route('admin.studyabroad')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }else{
            $page->banner_image = 'page-bg-area-img.jpg';
        }

        // Save the new page to the database
        $page->save();
        Route::get('page/' . $page->slug, [\App\Http\Controllers\frontend\HomeController::class, 'dynamicPage'])->name('frontend.' . $page->slug);

        //$this->addDynamicRoute($slug);

        // Redirect or return response
        return redirect()->route('admin.studyabroad')->with('success', 'Page created successfully');
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
        $pages = Page::all();
        $countries = Country::where('status', 1)->get();
        return view('pages.dashboard.page-study-abroad.edit', compact('page','pages', 'countries'));
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
        $page->type = 'study_abroad'; // Ensure the type is set to 'study_abroad'
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
                return redirect()->route('admin.studyabroad')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }

        $old_banner_image = $page->banner_image;
        if ($request->hasFile('file_input2')) {
                $filePath = 'public/assets/uploads/pages/';
                if ($old_banner_image && $old_banner_image != 'page-bg-area-img.jpg') {
                    $existingImagePath = $filePath . $page->banner_image;
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath); // Delete the old image
                    }
                }
                $filePath = 'assets/uploads/pages/';
                $file_input2 = $request->file('file_input2');
                $filename = $newSlug . '_' . time() . '.' . $file_input2->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input2->move(public_path($filePath), $filename)) {
                $page->banner_image = $filename;
            } else {
                $page->banner_image = '';
                return redirect()->route('admin.studyabroad')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }


        // Save the updated page
        $page->save();

        // Redirect or return response
        return redirect()->route('admin.studyabroad')->with('success', 'Page updated successfully');
    }


    // Delete page
    public function delete($id)
    {
        // Find the page by ID or fail if not found
        $page = Page::findOrFail($id);
        if (!$page) {
            return redirect()->route('admin.studyabroad')->with('error', 'Page not found.');
        }

        $defaultPages = ['home', 'about-us', 'page', 'gallery', 'music-tracks', 'music-videos','home-section-video'];

        // Check if the page is a default page
        if (in_array($page->slug, $defaultPages)) {
            return redirect()->route('admin.studyabroad')->with('error', 'You cannot delete the "' . $page->title . '" page as it is a default page.');
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
        return redirect()->route('admin.studyabroad')->with('success', 'Page status updated to inactive');

    }
}
