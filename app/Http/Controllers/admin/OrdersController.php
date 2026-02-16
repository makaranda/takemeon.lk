<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Size;
use App\Models\Color;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\DB;
use App\Models\Gallery;
use App\Models\GalleryItem;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrdersController extends Controller
{
    // Show all Products
    public function index()
    {

        $orders = Order::where('confirmation', 1)->get();
        $products = Product::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $subCategories = SubCategory::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $colors = Color::where('status', 1)->get();
        $productGalleries = ProductGallery::where('status', 1)->get();
        //dd($products);
        return view('pages.dashboard.orders.index', compact('products','orders', 'brands', 'categories', 'subCategories', 'sizes', 'colors', 'productGalleries'));
    }

    // Show create form
    public function create()
    {
        $products = Product::where('status',1)->get();
        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $sub_categories = SubCategory::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $colors = Color::where('status', 1)->get();
        $productGalleries = ProductGallery::where('status', 1)->get();
        return view('pages.dashboard.orders.create', compact('products', 'brands', 'categories', 'sub_categories', 'sizes', 'colors', 'productGalleries'));
    }

    public function getSubCategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)
            ->where('status', 1)
            ->get();

        return response()->json($subcategories);
    }

    // Store new Product
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
        $slugCount = \App\Models\Product::where('slug', $slug)->count();
        if ($slugCount > 0) {
            $slug = $slug . ($slugCount + 1); // append number to make it unique
        }

        // Create a new Product instance
        $author_id = auth()->id();

        $product = new \App\Models\Product();
        $product->product_code = 'PROD-' . strtoupper(Str::random(8)); // Generate a unique product code
        $product->title = $request->title;
        $product->slug = $slug;
        $product->description = $request->description;
        $product->sub_description = $request->sub_description;
        $product->seo_keywords = $request->seo_keywords;
        $product->seo_description = $request->seo_description;
        $product->order = $request->order;
        $product->category_id = $request->category_id;
        $product->sub_category = $request->sub_category;
        $product->price = $request->price ?? 1;
        $product->discount = $request->discount ?? 0;
        $product->qty = $request->qty ?? 1;
        $product->brand_id = $request->brand_id ?? 0;
        $product->size = $request->size ?? '';
        $product->color = $request->color ?? '';
        $product->route_name = 'frontend.'.$slug.'';
        $product->author_id = $author_id; // Assuming you want to set the author ID to the currently authenticated user
        $product->status = ($request->has('switch_publish') && $request->switch_publish == 'on') ? 1 : 0;
        $product->created_at = now();
        $product->updated_at = now();

        // Handle file upload for feature image
        if ($request->hasFile('file_input') && $request->file('file_input')->isValid()) {
            // Log the upload process
            \Log::info('Feature image is being uploaded');

            $filePath = 'assets/uploads/products/';
            $file_input = $request->file('file_input');
            $filename = 'feature_img_'.$slug . '_' . time() . '.' . $file_input->getClientOriginalExtension();

            if ($file_input->move(public_path($filePath), $filename)) {
                $product->feature_image = $filename;
            } else {
                $product->feature_image = '';
                //return redirect()->route('admin.products')->with('error', 'Sorry, there was an error uploading your file.');
            }
        } else {
            \Log::error('Feature image upload failed');
        }

        // Save the new Product to the database
        $product->save();
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $imageName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('assets/uploads/product-items/'), $imageName);

                DB::table('product_gallery')->insert([
                    'product_id' => $product->id,
                    'feature_image' => $imageName,
                    'order' => $key+1 ?? 0,
                    'status' => 1,
                    'author_id' => $author_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        Route::get('products/' . $product->slug, [\App\Http\Controllers\frontend\HomeController::class, 'dynamicProduct'])->name('frontend.' . $product->slug);

        //$this->addDynamicRoute($slug);

        // Redirect or return response
        return redirect()->route('admin.products')->with('success', 'Products created successfully');
    }

    // private function addDynamicRoute($slug)
    // {
    //     // Add the dynamic route for the Product
    //     Route::get('Product/' . $slug, [HomeController::class, 'dynamicProduct'])->name('frontend.' . $slug);
    // }

    // Show edit form
    public function edit($id)
    {

        $product = Product::findOrFail($id);
        $products = Product::where('status',1)->get();
        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $subCategories = SubCategory::where('status', 1)->get();
        $product_galleries = ProductGallery::where('product_id', $id)->where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $colors = Color::where('status', 1)->get();
        return view('pages.dashboard.orders.edit', compact('product','products', 'brands', 'categories', 'subCategories', 'sizes', 'colors', 'product_galleries'));
    }

    // Update Product
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

        // Find the Product by ID
        $product = \App\Models\Product::findOrFail($id);

        // Check if the title has changed, and regenerate the slug if necessary
        $newSlug = Str::slug($request->title);
        if ($newSlug !== $product->slug) {
            // If the slug is different, check if the new slug already exists
            $slugCount = \App\Models\Product::where('slug', $newSlug)->count();
            if ($slugCount > 0) {
                $newSlug = $newSlug . '-' . ($slugCount + 1); // append number to make it unique
            }
            $product->slug = $newSlug; // Update the slug
        }

        // Update Product data
        $author_id = auth()->id();

        $product->title = $request->title;
        $product->sub_description = $request->sub_description; // Updated to match the input field
        $product->description = $request->description;
        $product->seo_keywords = $request->seo_keywords;
        $product->seo_description = $request->seo_description;
        $product->order = $request->order;
        $product->category_id = $request->category_id;
        $product->sub_category = $request->sub_category;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->qty = $request->qty;
        $product->brand_id = $request->brand_id;
        $product->size = $request->size;
        $product->color = $request->color;
        $product->author_id = $author_id;
        $product->route_name = 'frontend.'.$newSlug.'';
        $product->status = $request->has('switch_publish') && $request->switch_publish == 'on' ? 1 : 0;

        // Handle file upload for feature image if provided
        //dd($request->file_input);
        if ($request->hasFile('file_input')) {
                $filePath = 'public/assets/uploads/products/';
                if ($product->feature_image) {
                    $existingImagePath = $filePath . $product->feature_image;
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath); // Delete the old image
                    }
                }
                $filePath = 'assets/uploads/products/';
                $file_input = $request->file('file_input');
                $filename = $newSlug . '_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $product->feature_image = $filename;
            } else {
                $product->feature_image = '';
                return redirect()->route('admin.products')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }

        // Save the updated Product
        $product->save();

        if ($request->has('remove_imgs')) {
            $removeList = explode(',', $request->remove_imgs); // ["4/1", "4/3"]

            foreach ($removeList as $entry) {
                list($productId, $imageId) = explode('/', $entry);

                $galleryImage = DB::table('product_gallery')
                    ->where('id', $imageId)
                    ->where('product_id', $productId)
                    ->first();

                if ($galleryImage) {
                    // Delete image file from disk
                    $imagePath = public_path('assets/uploads/product-items/' . $galleryImage->feature_image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }

                    // Delete DB record
                    DB::table('product_gallery')
                        ->where('id', $imageId)
                        ->where('product_id', $productId)
                        ->delete();
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $imageName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('assets/uploads/product-items/'), $imageName);

                DB::table('product_gallery')->insert([
                    'product_id' => $product->id,
                    'feature_image' => $imageName,
                    'order' => $key+1 ?? 0,
                    'status' => 1,
                    'author_id' => $author_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Redirect or return response
        return redirect()->route('admin.products')->with('success', 'Products updated successfully');
    }


    // Delete Product
    public function delete($id)
    {
        // Find the Product by ID or fail if not found
        $product = Product::findOrFail($id);
        if (!$product) {
            return redirect()->route('admin.products')->with('error', 'Product not found.');
        }

        $defaultProducts = ['home', 'about-us', 'Product', 'gallery', 'music-tracks', 'music-videos','home-section-video'];

        // Check if the Product is a default Product
        if (in_array($product->slug, $defaultProducts)) {
            return redirect()->route('admin.products')->with('error', 'You cannot delete the "' . $product->title . '" Product as it is a default Product.');
        }
        // If the Product has a feature image, delete it from storage

        // if ($product->feature_image) {
        //     Storage::delete('public/assets/uploads/products/' . $product->feature_image);
        // }
        if (!empty($product->feature_image) && Storage::exists('public/assets/uploads/products/' . $product->feature_image)) {
            Storage::delete('public/assets/uploads/products/' . $product->feature_image);
        }
        // Update the Product status to 0 (inactive) instead of deleting it
        $product->status = 0;
        $product->save();

        // Redirect with success message
        return redirect()->route('admin.products')->with('success', 'Product status updated to inactive');

    }

    public function fetchOrderItems($order_id){
        $order = Order::with('orderItems.product')->find($order_id);

        if (!$order || $order->orderItems->isEmpty()) {
            return response()->json([
                'status' => 0,
                'items' => ''
            ]);
        }
         // Create HTML view content dynamically
        $html = '<div class="table-responsive"><table class="table table-bordered"><thead><tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr></thead><tbody>';

        foreach ($order->orderItems as $index => $item) {
            $html .= '<tr>
                        <td>' . ($index + 1) . '</td>
                        <td>' . $item->product->title . '</td>
                        <td>' . $item->qty . '</td>
                        <td>' . number_format($item->amount, 2) . '</td>
                        <td>' . number_format($item->qty * $item->amount, 2) . '</td>
                    </tr>';
        }

        $html .= '</tbody></table></div>';

        return response()->json([
            'status' => 1,
            'items' => $html
        ]);
    }
}
