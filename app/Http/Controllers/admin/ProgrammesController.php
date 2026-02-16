<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Programme;
use App\Models\According;
use App\Models\ProgramCategory;
use App\Models\ProgramSubCategory;
use App\Models\ProgramSubCategoryItem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Constants\Countries;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProgrammesController extends Controller
{
    public function index()
    {
        $defaultPages = ['home','page', 'music-tracks', 'music-videos', 'home-section-video'];
        $programmes_list = Programme::where('status', 1)->get();
        $allProgrammes = Programme::where('status', 1)
                        ->orderBy('order','asc')
                        ->get();

        $programmes = $allProgrammes->where('parent',0);

                        //dd($programmes);
        $children = $allProgrammes->where('parent','>',0)->groupBy('parent');
        //$children_subs = $children->where('parent','>',0)->groupBy('parent');
        $children_subs = collect();

        foreach ($children as $parentId => $childItems) {
            foreach ($childItems as $child) {
                $childChildren = $allProgrammes->where('parent', $child->id);
                if ($childChildren->isNotEmpty()) {
                    $children_subs[$child->id] = $childChildren;
                }
            }
        }

        return view('pages.dashboard.programme.index', compact('programmes', 'children','children_subs','programmes_list'));
    }

    public function getSubcategories($categoryId)
    {
        $category = ProgramCategory::with('subCategories.items')
            ->findOrFail($categoryId);

        return response()->json($category->subCategories);
    }


      public function updateOrder(Request $request,$id)
    {
        //dd($request->all());
        $partner = Programme::findOrFail($id);
        $partner->update([
            'order' => $request->order_no_current ?? 0,
        ]);

        return redirect()->route('admin.programmes')->with('success', 'Order Number updated successfully.');
    }

    public function updatePageID(Request $request,$id)
    {
        //dd($request->all());
        $partner = Programme::findOrFail($id);
        $partner->update([
            'parent' => $request->page_no_current ?? 0,
        ]);

        return redirect()->route('admin.programmes')->with('success', 'Page ID is updated successfully.');
    }

    // Show create form programme ProgrammeController
    public function create()
    {
        $programmes = Programme::all();
        $countries = Countries::LIST;
        $categories = ProgramCategory::all();
        //dd($categories);
        return view('pages.dashboard.programme.create', compact('programmes','countries','categories'));
    }

    // Store new page
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'country' => 'required|string',
            'sub_description' => 'nullable|string',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        // Generate slug from the title
        $slug = Str::slug($request->title);

        // Check if the slug exists, if so, add a number to make it unique
        $slugCount = \App\Models\Programme::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = $slug . ($slugCount + 1); // append number to make it unique
        }

        // Create a new Page instance
        $programme = new \App\Models\Programme();
        $programme->title = $request->title;
        $programme->slug = $slug;
        $programme->description = $request->description;
        $programme->country = $request->country;
        $programme->category = $request->category;
        $programme->sub_category = $request->subcategory;
        $programme->sub_description = $request->sub_description;
        $programme->seo_keywords = $request->seo_keywords;
        $programme->seo_description = $request->seo_description;
        $programme->order = $request->order;
        $page->author_id = auth()->user()->id;
        $programme->parent = $request->parent ?? 0; // Set parent to 0 for top-level pages
        $programme->route_name = 'frontend.'.$slug.'';
        $programme->status = ($request->has('switch_publish') && $request->switch_publish == 'on') ? 1 : 0;

        // Handle file upload for feature image
        if ($request->hasFile('file_input') && $request->file('file_input')->isValid()) {
            // Log the upload process
            \Log::info('Feature image is being uploaded');

            $filePath = 'assets/uploads/programmes/';
            $file_input = $request->file('file_input');
            $filename = $slug . '_' . time() . '.' . $file_input->getClientOriginalExtension();

            if ($file_input->move(public_path($filePath), $filename)) {
                $programme->feature_image = $filename;
            } else {
                $programme->feature_image = '';
                //return redirect()->route('admin.programmes')->with('error', 'Sorry, there was an error uploading your file.');
            }
        } else {
            \Log::error('Feature image upload failed');
        }

        // Save the new page to the database
        $programme->save();
        Route::get('page/' . $programme->slug, [\App\Http\Controllers\frontend\HomeController::class, 'dynamicPage'])->name('frontend.' . $programme->slug);

        //$this->addDynamicRoute($slug);

        // Redirect or return response
        return redirect()->route('admin.programmes')->with('success', 'Programme created successfully');
    }

    // private function addDynamicRoute($slug)
    // {
    //     // Add the dynamic route for the page
    //     Route::get('page/' . $slug, [HomeController::class, 'dynamicPage'])->name('frontend.' . $slug);
    // }

    // Show edit form
    public function edit($id)
    {

        $programme = Programme::findOrFail($id);
        $programmes = Programme::all();
        $countries = Countries::LIST;
        $categories = ProgramCategory::all();
        return view('pages.dashboard.programme.edit', compact('programme','programmes','categories','countries'));
    }

    // Update page
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'sub_description' => 'nullable|string', // Make sure to update this to 'short_description'
            'description' => 'nullable|string',
            'seo_keywords' => 'nullable',
            'seo_description' => 'nullable',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);
//dd($validator);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator) // adds errors to the session
                ->withInput() // keeps the old input data
                ->with('error', 'Please fix the validation errors.'); // custom general message
        }
        //dd($validator->fails());
        // Find the page by ID
        $programme = \App\Models\Programme::findOrFail($id);

        // Check if the title has changed, and regenerate the slug if necessary
        $newSlug = Str::slug($request->title);
        if ($newSlug !== $programme->slug) {
            // If the slug is different, check if the new slug already exists
            $slugCount = \App\Models\Programme::where('slug', $newSlug)->count();
            if ($slugCount > 0) {
                $newSlug = $newSlug . '-' . ($slugCount + 1); // append number to make it unique
            }
            $programme->slug = $newSlug; // Update the slug
        }

        // Update page data
        $programme->title = $request->title;
        $programme->sub_description = $request->sub_description; // Updated to match the input field
        $programme->description = $request->description;
        $programme->country = $request->country;
        $programme->category = $request->category;
        $programme->sub_category = $request->subcategory;
        $programme->seo_keywords = $request->seo_keywords;
        $programme->seo_description = $request->seo_description;
        $programme->order = $request->order;
        $programme->author_id = Auth::user()->id;
        $programme->parent = $request->parent ?? $programme->parent; // Set parent to 0 for top-level pages
        $programme->route_name = 'frontend.'.$newSlug.'';
        $programme->status = $request->has('switch_publish') && $request->switch_publish == 'on' ? 1 : 0;
        
        //dd($request->sub_description);

        // Handle file upload for feature image if provided
        //dd($request->file_input);
        if ($request->hasFile('file_input')) {
                $filePath = 'public/assets/uploads/programmes/';
                if ($programme->feature_image) {
                    $existingImagePath = $filePath . $programme->feature_image;
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath); // Delete the old image
                    }
                }
                $filePath = 'assets/uploads/programmes/';
                $file_input = $request->file('file_input');
                $filename = $newSlug . '_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $programme->feature_image = $filename;
            } else {
                $programme->feature_image = '';
                return redirect()->route('admin.programmes')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }else{
             $programme->feature_image =  $programme->feature_image;
        }

        // Save the updated page
        $programme->save();

        // Redirect or return response
        return redirect()->route('admin.programmes')->with('success', 'Programme updated successfully');
    }


    // Delete page
    public function delete($id)
    {
        // Find the page by ID or fail if not found
        $programme = Programme::findOrFail($id);
        if (!$programme) {
            return redirect()->route('admin.programmes')->with('error', 'Programme not found.');
        }

        $defaultPages = ['home', 'about-us', 'page', 'gallery', 'music-tracks', 'music-videos','home-section-video'];

        // Check if the page is a default page
        if (in_array($programme->slug, $defaultPages)) {
            return redirect()->route('admin.programmes')->with('error', 'You cannot delete the "' . $programme->title . '" page as it is a default page.');
        }
        // If the page has a feature image, delete it from storage

        // if ($programme->feature_image) {
        //     Storage::delete('public/assets/uploads/programmes/' . $programme->feature_image);
        // }
        if (!empty($programme->feature_image) && Storage::exists('public/assets/uploads/programmes/' . $programme->feature_image)) {
            Storage::delete('public/assets/uploads/programmes/' . $programme->feature_image);
        }
        // Update the page status to 0 (inactive) instead of deleting it
        $programme->status = 0;
        $programme->save();

        // Redirect with success message
        return redirect()->route('admin.programmes')->with('success', 'Programme status updated to inactive');

    }
}
