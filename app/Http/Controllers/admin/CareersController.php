<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Career;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CareersController extends Controller
{
     public function index()
    {
        $careers = Career::where('status', 1)
                    ->get();
        return view('pages.dashboard.careers.index', compact('careers'));
    }

    // Show create form
    public function create()
    {
        $careers = Career::all();
        return view('pages.dashboard.careers.create', compact('careers'));
    }

    // Store new Career
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sub_description' => 'nullable|string',
            'file_input' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        // Generate slug from the title
        $slug = Str::slug($request->title);

        // Check if the slug exists, if so, add a number to make it unique
        $slugCount = \App\Models\Career::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = $slug . ($slugCount + 1); // append number to make it unique
        }

        // Create a new Career instance
        $career = new \App\Models\Career();
        $career->title = $request->title;
        $career->slug = $slug;
        $career->description = $request->description;
        $career->sub_description = $request->sub_description;
        $career->order = $request->order;
        $career->email = $request->email ?? '';
        $career->closing_date = $request->closing_date ?? '';
        $career->whatsapp = $request->whatsapp ?? '';
        $career->author_id = auth()->user()->id; // Set the author ID to the currently authenticated user
        $career->status = ($request->has('switch_publish') && $request->switch_publish == 'on') ? 1 : 0;

        // Handle file upload for feature image
        if ($request->hasFile('file_input') && $request->file('file_input')->isValid()) {
            // Log the upload process
            \Log::info('Feature image is being uploaded');

            $filePath = 'assets/uploads/careers/';
            $file_input = $request->file('file_input');
            $filename = $slug . '_' . time() . '.' . $file_input->getClientOriginalExtension();

            if ($file_input->move(public_path($filePath), $filename)) {
                $career->feature_image = $filename;
            } else {
                $career->feature_image = '';
                //return redirect()->route('admin.Careers')->with('error', 'Sorry, there was an error uploading your file.');
            }
        } else {
            \Log::error('Feature image upload failed');
        }

        // Save the new Career to the database
        $career->save();
        Route::get('career/' . $career->slug, [\App\Http\Controllers\frontend\HomeController::class, 'dynamicCareer'])->name('frontend.' . $career->slug);

        //$this->addDynamicRoute($slug);

        // Redirect or return response
        return redirect()->route('admin.careers')->with('success', 'Career created successfully');
    }

    // private function addDynamicRoute($slug)
    // {
    //     // Add the dynamic route for the Career
    //     Route::get('Career/' . $slug, [HomeController::class, 'dynamicCareer'])->name('frontend.' . $slug);
    // }

    // Show edit form
    public function edit($id)
    {

        $career = Career::findOrFail($id);
        $careers = Career::all();
        return view('pages.dashboard.careers.edit', compact('career','careers'));
    }

    // Update Career
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_description' => 'nullable|string', // Make sure to update this to 'short_description'
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
            'file_input' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust file input validation
        ]);

        // Find the Career by ID
        $career = \App\Models\Career::findOrFail($id);

        // Check if the title has changed, and regenerate the slug if necessary
        $newSlug = Str::slug($request->title);
        if ($newSlug !== $career->slug) {
            // If the slug is different, check if the new slug already exists
            $slugCount = \App\Models\Career::where('slug', $newSlug)->count();
            if ($slugCount > 0) {
                $newSlug = $newSlug . '-' . ($slugCount + 1); // append number to make it unique
            }
            $career->slug = $newSlug; // Update the slug
        }

        // Update Career data
        $career->title = $request->title;
        $career->sub_description = $request->sub_description; // Updated to match the input field
        $career->description = $request->description;
        $career->order = $request->order;
        $career->email = $request->email ?? '';
        $career->closing_date = $request->closing_date ?? '';
        $career->whatsapp = $request->whatsapp ?? '';
        $career->author_id = auth()->user()->id;
        $career->status = $request->has('switch_publish') && $request->switch_publish == 'on' ? 1 : 0;

        // Handle file upload for feature image if provided
        //dd($request->file_input);
        if ($request->hasFile('file_input')) {
                $filePath = 'public/assets/uploads/careers/';
                if ($career->feature_image) {
                    $existingImagePath = $filePath . $career->feature_image;
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath); // Delete the old image
                    }
                }
                $filePath = 'assets/uploads/careers/';
                $file_input = $request->file('file_input');
                $filename = $newSlug . '_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $career->feature_image = $filename;
            } else {
                $career->feature_image = '';
                return redirect()->route('admin.careers')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }



        // Save the updated Career
        $career->save();

        // Redirect or return response
        return redirect()->route('admin.careers')->with('success', 'Career updated successfully');
    }


    // Delete Career
    public function delete($id)
    {
        // Find the Career by ID or fail if not found
        $career = Career::findOrFail($id);
        if (!$career) {
            return redirect()->route('admin.careers')->with('error', 'Career not found.');
        }

        $defaultCareers = ['home', 'about-us', 'career', 'gallery', 'music-tracks', 'music-videos','home-section-video'];

        // Check if the Career is a default Career
        if (in_array($career->slug, $defaultCareers)) {
            return redirect()->route('admin.careers')->with('error', 'You cannot delete the "' . $career->title . '" Career as it is a default Career.');
        }
        // If the Career has a feature image, delete it from storage

        // if ($career->feature_image) {
        //     Storage::delete('public/assets/uploads/Careers/' . $career->feature_image);
        // }
        if (!empty($career->feature_image) && Storage::exists('public/assets/uploads/Careers/' . $career->feature_image)) {
            Storage::delete('public/assets/uploads/careers/' . $career->feature_image);
        }
        // Update the Career status to 0 (inactive) instead of deleting it
        $career->status = 0;
        $career->save();

        // Redirect with success message
        return redirect()->route('admin.careers')->with('success', 'Career status updated to inactive');

    }
}
