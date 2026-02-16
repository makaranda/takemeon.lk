<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogsController extends Controller
{
    // Show all Blogs
    public function index()
    {
        $blogs = Blog::where('status', 1)
                    ->get();
        return view('pages.dashboard.blogs.index', compact('blogs'));
    }

    // Show create form
    public function create()
    {
        $blogs = Blog::all();
        return view('pages.dashboard.blogs.create', compact('blogs'));
    }

    // Store new Blog
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sub_description' => 'nullable|string',
            'blog_type' => 'required',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        // Generate slug from the title
        $slug = Str::slug($request->title);

        // Check if the slug exists, if so, add a number to make it unique
        $slugCount = \App\Models\Blog::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = $slug . ($slugCount + 1); // append number to make it unique
        }

        // Create a new Blog instance
        $blog = new \App\Models\Blog();
        $blog->title = $request->title;
        $blog->slug = $slug;
        $blog->description = $request->description;
        $blog->sub_description = $request->sub_description;
        $blog->seo_keywords = $request->seo_keywords;
        $blog->seo_description = $request->seo_description;
        //$blog->blog_type = $request->blog_type;
        $blog->blog_type = 'blogs-article';
        $blog->order = $request->order;
        $blog->route_name = 'frontend.'.$slug.'';
        $blog->status = ($request->has('switch_publish') && $request->switch_publish == 'on') ? 1 : 0;

        // Handle file upload for feature image
        if ($request->hasFile('file_input') && $request->file('file_input')->isValid()) {
            // Log the upload process
            \Log::info('Feature image is being uploaded');

            $filePath = 'assets/uploads/blogs/';
            $file_input = $request->file('file_input');
            $filename = $slug . '_' . time() . '.' . $file_input->getClientOriginalExtension();

            if ($file_input->move(public_path($filePath), $filename)) {
                $blog->feature_image = $filename;
            } else {
                $blog->feature_image = '';
                //return redirect()->route('admin.Blogs')->with('error', 'Sorry, there was an error uploading your file.');
            }
        } else {
            \Log::error('Feature image upload failed');
        }

        // Save the new Blog to the database
        $blog->save();
        Route::get('blog/' . $blog->slug, [\App\Http\Controllers\frontend\HomeController::class, 'dynamicBlog'])->name('frontend.' . $blog->slug);

        //$this->addDynamicRoute($slug);

        // Redirect or return response
        return redirect()->route('admin.blogs')->with('success', 'Blog created successfully');
    }

    // private function addDynamicRoute($slug)
    // {
    //     // Add the dynamic route for the Blog
    //     Route::get('Blog/' . $slug, [HomeController::class, 'dynamicBlog'])->name('frontend.' . $slug);
    // }

    // Show edit form
    public function edit($id)
    {

        $blog = Blog::findOrFail($id);
        $blogs = Blog::all();
        return view('pages.dashboard.blogs.edit', compact('blog','blogs'));
    }

    // Update Blog
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_description' => 'nullable|string', // Make sure to update this to 'short_description'
            'description' => 'nullable|string',
            'blog_type' => 'required',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
            'file_input' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust file input validation
        ]);

        // Find the Blog by ID
        $blog = \App\Models\Blog::findOrFail($id);

        // Check if the title has changed, and regenerate the slug if necessary
        $newSlug = Str::slug($request->title);
        if ($newSlug !== $blog->slug) {
            // If the slug is different, check if the new slug already exists
            $slugCount = \App\Models\Blog::where('slug', $newSlug)->count();
            if ($slugCount > 0) {
                $newSlug = $newSlug . '-' . ($slugCount + 1); // append number to make it unique
            }
            $blog->slug = $newSlug; // Update the slug
        }

        // Update Blog data
        $blog->title = $request->title;
        $blog->sub_description = $request->sub_description; // Updated to match the input field
        $blog->description = $request->description;
        $blog->seo_keywords = $request->seo_keywords;
        $blog->seo_description = $request->seo_description;
        //$blog->blog_type = $request->blog_type;
        $blog->blog_type = 'blogs-article';
        $blog->order = $request->order;
        $blog->route_name = 'frontend.'.$newSlug.'';
        $blog->status = $request->has('switch_publish') && $request->switch_publish == 'on' ? 1 : 0;

        // Handle file upload for feature image if provided
        //dd($request->file_input);
        if ($request->hasFile('file_input')) {
                $filePath = 'public/assets/uploads/blogs/';
                if ($blog->feature_image) {
                    $existingImagePath = $filePath . $blog->feature_image;
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath); // Delete the old image
                    }
                }
                $filePath = 'assets/uploads/blogs/';
                $file_input = $request->file('file_input');
                $filename = $newSlug . '_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $blog->feature_image = $filename;
            } else {
                $blog->feature_image = '';
                return redirect()->route('admin.blogs')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }



        // Save the updated Blog
        $blog->save();

        // Redirect or return response
        return redirect()->route('admin.blogs')->with('success', 'Blog updated successfully');
    }


    // Delete Blog
    public function delete($id)
    {
        // Find the Blog by ID or fail if not found
        $blog = Blog::findOrFail($id);
        if (!$blog) {
            return redirect()->route('admin.Blogs')->with('error', 'Blog not found.');
        }

        $defaultBlogs = ['home', 'about-us', 'Blog', 'gallery', 'music-tracks', 'music-videos','home-section-video'];

        // Check if the Blog is a default Blog
        if (in_array($blog->slug, $defaultBlogs)) {
            return redirect()->route('admin.Blogs')->with('error', 'You cannot delete the "' . $blog->title . '" Blog as it is a default Blog.');
        }
        // If the Blog has a feature image, delete it from storage

        // if ($blog->feature_image) {
        //     Storage::delete('public/assets/uploads/blogs/' . $blog->feature_image);
        // }
        if (!empty($blog->feature_image) && Storage::exists('public/assets/uploads/blogs/' . $blog->feature_image)) {
            Storage::delete('public/assets/uploads/blogs/' . $blog->feature_image);
        }
        // Update the Blog status to 0 (inactive) instead of deleting it
        $blog->status = 0;
        $blog->save();

        // Redirect with success message
        return redirect()->route('admin.blogs')->with('success', 'Blog status updated to inactive');

    }
}
