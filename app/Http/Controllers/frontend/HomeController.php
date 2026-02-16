<?php

namespace App\Http\Controllers\frontend;

use App\Helpers\VisitorHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\MainSlider;
//use App\Models\MusicTrack;
use App\Models\Page;
use App\Models\ContactUs;
use App\Models\Setting;
use App\Models\Career;
use App\Models\GalleryHome;
use App\Models\Gallery;
use App\Models\GalleryItem;
use App\Models\According;
use App\Models\Programme;
use App\Models\University;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Size;
use App\Models\Color;
use App\Models\District;
use App\Models\ProgramCategory;
use App\Models\ProgramSubCategory;
use App\Models\ProgramSubCategoryItem;
use App\Models\Partner;
use App\Models\Blog;
use App\Models\Country;
use App\Models\Link;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingCharge;
//use App\Observers\VisitorCountObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Helpers\SmsHelper;

class HomeController extends Controller
{

    public function index()
    {
        VisitorHelper::updateVisitorCount();

        $main_slider = MainSlider::where('status', 1)->get(); // Assuming there's only one main slider
        //$music_tracks = MusicTrack::where('status', 1)->where('type', 'audio')->orderBy('order', 'asc')->orderBy('created_at', 'desc')->take(7)->get();
        //$banner_music_tracks = MusicTrack::where('status', 1)->where('type', 'audio')->where('order', 0)->first();
        //$music_beats = MusicTrack::where('status', 1)->where('type', 'beat')->orderBy('order', 'asc')->orderBy('created_at', 'desc')->take(7)->get();
        //$video_tracks = MusicTrack::where('status', 1)->where('type', 'video')->orderBy('order', 'asc')->orderBy('created_at', 'desc')->take(8)->get();
        $about_info = Page::where('slug', 'LIKE', 'about-us')->where('status', 1)->first(); // Assuming a single about section
        $gallery_home = GalleryHome::where('status', 1)->get();
        $according_home = According::where('status', 1)->where('type', 'home')->orderBy('order', 'asc')->get();
        $partners_home = Partner::where('status', 1)->orderBy('order', 'asc')->get();
        $home_sec_video = Page::where('status', 1)->where('id', 34)->first();
        $random_products = Product::where('status', 1)->inRandomOrder()->take(6)->get();
        $random_blogs = Blog::where('status', 1)->inRandomOrder()->take(3)->get();
        //$admin = Auth::guard('admin')->user();
        //dd($admin);
        // if (!empty($admin->role) && $admin->role > 0) {
        //     return redirect()->route('admin.dashboard');
        // } else {
        return view('pages.frontend.home.index', compact('gallery_home', 'home_sec_video',  'about_info', 'main_slider', 'according_home', 'partners_home', 'random_products', 'random_blogs'));
        //}
    }

    public function construction()
    {
        VisitorHelper::updateVisitorCount();
        return view('pages.frontend.construction.index'); // Make sure this view exists
    }

    public function contactUs()
    {
        VisitorHelper::updateVisitorCount();

        $page_contact = Page::where('slug', 'Like', 'contact-us')->first();
        return view('pages.frontend.contact.index', compact('page_contact')); // Make sure this view exists
    }

    public function aboutUs()
    {
        VisitorHelper::updateVisitorCount();
        $about_info = Page::where('slug', 'Like', 'about-us')->first();

        return view('pages.frontend.about.index', compact('about_info')); // Make sure this view exists
    }

    public function privacyPolicy()
    {
        VisitorHelper::updateVisitorCount();
        $page_info = Page::where('slug', 'Like', 'privacy-and-policy')->first();

        return view('pages.frontend.privacy.index', compact('page_info'));
    }

    public function enroll()
    {
        VisitorHelper::updateVisitorCount();
        $enroll = Page::where('slug', 'Like', 'enroll')->first();
        $application_form = Link::where('status', 1)->where('type', 'application')->get();
        $settings = Setting::first();

        return view('pages.frontend.enroll.index', compact('enroll', 'application_form', 'settings')); // Make sure this view exists
    }

    public function payOnline()
    {
        VisitorHelper::updateVisitorCount();
        $payonline = Page::where('slug', 'Like', 'pay-online')->first();
        $application_form = Link::where('status', 1)->where('type', 'application')->get();
        $settings = Setting::first();

        return view('pages.frontend.payonline.index', compact('payonline', 'application_form', 'settings')); // Make sure this view exists
    }

    public function studyAbroadUniversities($slug)
    {
        VisitorHelper::updateVisitorCount();

        $pages = Page::where('status', 1)->get();
        $study_abroad = Page::where('status', 1)->where('type', 'study_abroad')->where('slug', 'like', '%' . $slug . '%')->first();
        if ($study_abroad && $study_abroad->attributes) {
            $attributes = $study_abroad->attributes;
        } else {
            $attributes = [];
        }
        $country_id = $attributes['country'];
        $country = Country::where('id', $country_id)->where('status', 1)->first();
        $settings = Setting::first();
        $universities = University::where('status', 1)->where('page_id', $study_abroad->id)->get();
        $university_links = Link::where('status', 1)->where('page_id', $study_abroad->id)->where('type', 'study_abroad')->get();


        //dd($study_abroad);
        if (!$study_abroad) {
            abort(404, 'Study Abroad page not found');
        }
        return view('pages.frontend.study_abroad.single', compact('pages', 'study_abroad', 'universities', 'settings', 'country', 'university_links')); // Make sure this view exists
        //{{ route('frontend.programmes.show', $item['slug']) }}
    }

    public function programmes()
    {
        VisitorHelper::updateVisitorCount();
        $programmes = Programme::where('status', 1)->get();
        $settings = Setting::first();
        $program_categories = ProgramCategory::where('status', 1)->get();
        // dd($program_categories);
        return view('pages.frontend.programmes.index', compact('programmes', 'program_categories', 'settings')); // Make sure this view exists
    }

    public function programmeCategories($slug)
    {
        VisitorHelper::updateVisitorCount();

        $programme = Programme::where('status', 1)->get();
        //$program_category = ProgramCategory::where('status', 1)->where('slug','like','%'.$slug.'%')->first();
        //$category_id = $program_category['id'] ?? 0;
        //dd($program_category->name);
        //$program_sub_categories = ProgramSubCategory::where('category_id',$category_id)->where('status', 1)->get();
        $program_sub_categories = ProgramSubCategory::where('slug', 'like', '%' . $slug . '%')->where('status', 1)->first();
        $program_category = ProgramCategory::where('status', 1)->where('id', $program_sub_categories->category_id)->first();
        //dd($program_sub_categories);
        $category_id = $program_category['id'] ?? 0;
        //dd($program_sub_categories);
        $settings = Setting::first();

        $program_sub_category_items = ProgramSubCategoryItem::where('status', 1)->get();
        return view('pages.frontend.programmes.subcategories', compact('programme', 'program_sub_categories', 'program_sub_category_items', 'program_category', 'settings')); // Make sure this view exists
        //{{ route('frontend.programmes.show', $item['slug']) }}
    }

    public function programmeSubCategories($slug, $sub_slug)
    {
        VisitorHelper::updateVisitorCount();
        //dd($slug,$sub_slug);
        $program_sub_category = ProgramSubCategory::where('slug', $slug)->where('status', 1)->first();
        $program_sub_category_item = ProgramSubCategoryItem::where('slug', $sub_slug)->where('status', 1)->first();
        $settings = Setting::first();
        //dd($program_sub_category_item->id,$program_sub_category->category_id);
        //dd($program_sub_category_item->name);
        if (isset($program_sub_category->category_id) && $program_sub_category->category_id == 2) {
            $programme = Programme::where('status', 1)->where('slug', 'LIKE', '%' . $sub_slug . '%')->where('parent', '!=', 0)->first();
            $accordings = According::where('page_id', $programme->id)->where('status', 1)->where('type', 'programme')->orderBy('order', 'asc')->get();
            //dd($programme);
            return view('pages.frontend.programmes.programmedetails2', compact('settings', 'programme', 'accordings'));
        } else {
            //dd($program_sub_category->category_id,$program_sub_category_item->id);
            $programmes = Programme::where('status', 1)->where('category', $program_sub_category->category_id)->where('slug', 'NOT LIKE', '%' . $sub_slug . '%')->where('sub_category', $program_sub_category_item->id)->where('parent', '!=', 0)->get();
            $programme_content = Programme::where('status', 1)->where('category', $program_sub_category->category_id)->where('sub_category', $program_sub_category_item->id)->where('parent', 0)->first();
            return view('pages.frontend.programmes.subcategoryitem', compact('programmes', 'program_sub_category', 'program_sub_category_item', 'settings', 'programme_content'));
        }

        //exit();
        //echo $slug,$sub_slug;
        //dd($program_sub_category->category_id,$program_sub_category_item->id);
        //dd($programme_content);

    }

    public function programmeItem($slug, $sub_slug, $sub_sub_slug)
    {
        VisitorHelper::updateVisitorCount();
        //echo $slug,$sub_slug,$sub_sub_slug;
        $programme = Programme::where('slug', $sub_sub_slug)->where('status', 1)->firstOrFail();
        $settings = Setting::first();
        //dd($programme);
        return view('pages.frontend.programmes.programmedetails', compact('programme', 'settings')); // Make sure this view exists
    }

    public function gallery()
    {
        VisitorHelper::updateVisitorCount();
        return view('pages.frontend.gallery.index'); // Make sure this view exists
    }

    // public function musicTracks()
    // {
    //     VisitorHelper::updateVisitorCount();
    //     $music_tracks = MusicTrack::where('status', 1)->where('type', 'audio')->orderBy('order', 'asc')->get();
    //     $music_beats = MusicTrack::where('status', 1)->where('type', 'beat')->orderBy('order', 'asc')->get();

    //     return view('pages.frontend.musictracks.index', compact('music_tracks', 'music_beats')); // Make sure this view exists
    // }

    // public function musicVideos()
    // {
    //     VisitorHelper::updateVisitorCount();
    //     $video_tracks = MusicTrack::where('status', 1)->where('type', 'video')->orderBy('order', 'asc')->get();

    //     return view('pages.frontend.videotracks.index', compact('video_tracks')); // Make sure this view exists
    // }

    public function dynamicPage($slug)
    {
        // Update visitor count
        VisitorHelper::updateVisitorCount();

        // Fetch the page from the database
        $page = Page::where('slug', $slug)->first();

        // Check if the page exists
        if (!$page) {
            // Handle the case where the page is not found
            abort(404, 'Page not found');
        }

        // Return the page view with the page data
        return view('pages.frontend.dynamic.index', compact('page'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => 'required',
            'name' => 'required|string|max:255',
            'message' => 'required',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
        ]);

        // Verify reCAPTCHA v3
        $recaptchaSecret = config('services.recaptcha.secret');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$request->input('g-recaptcha-response')}");
        $recaptchaData = json_decode($response);

        if (!$recaptchaData->success || $recaptchaData->score < 0.5) {
            return back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed.']);
        }

        $setting = Setting::first();

        // Store Contact Form Data
        $contactData = ContactUs::create([
            'name' => $request->name,
            'message' => $request->message,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $request->subject,
            'ip_address' => $request->ip(),
            'mac_address' => substr(exec('getmac'), 0, 17),
            'device' => $request->header('User-Agent'),
        ]);

        // Send Email to Owner using PHPMailer
        try {
            $mail = new PHPMailer(true);

            // Set up the SMTP connection (adjust SMTP details accordingly)
            $mail->isSMTP();
            $mail->Host = 'mail.kingvikingrecords.com'; // For example, use your SMTP host here
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME'); // Set your SMTP username from .env file
            $mail->Password = env('MAIL_PASSWORD'); // Set your SMTP password from .env file
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587; // Or 465 for SSL

            // Set the sender and recipient details
            $mail->setFrom($request->email, $request->name); // The sender's email and name
            //$mail->addAddress(env('MAIL_OWNER')); // Set the recipient email (Owner's email)
            $mail->addAddress('makarandapathirana@gmail.com'); // Set the recipient email (Owner's email)

            // Set email subject and body content
            $mail->isHTML(true);
            $mail->Subject = 'New Contact Form Message: ' . $request->subject;
            $mail->Body = view('templates.email.contact_message', [
                'data' => $contactData,
                'setting' => $setting,
            ])->render(); // Passing the data to the view

            // Send the email
            $mail->send();

        } catch (Exception $e) {
            // If something goes wrong with the email, log the error
            Log::error('Email could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        }

        return back()->with('success', 'Your message has been sent successfully.');
    }

    public function showCareers()
    {
        $career_page = Page::where('slug', 'Like', 'careers')->first();
        $settings = Setting::first();
        $careers = Career::where('status', 1)->get();

        return view('pages.frontend.careers.index', compact('careers', 'settings', 'career_page'));
    }

    public function viewCareer($slug)
    {
        $career_page = Page::where('slug', 'Like', 'careers')->first();
        $settings = Setting::first();
        $career = Career::where('status', 1)->where('slug', 'like', '%' . $slug . '%')->first();

        return view('pages.frontend.careers.single', compact('career', 'settings', 'career_page'));
    }

    public function showEvents()
    {
        $galleries = Gallery::where('status', 1)->get();
        $galleries_group = Gallery::where('status', 1)->orderByDesc('year')->get()->unique('year')->values();
        $events = Page::where('slug', 'Like', 'events')->first();
        $settings = Setting::first();
        return view('pages.frontend.gallery.index', compact('galleries', 'settings', 'events', 'galleries_group'));
        //echo 'Events';
    }

    public function viewEvent($slug)
    {
        $gallery = Gallery::where('status', 1)->where('slug', 'like', '%' . $slug . '%')->first();
        $gallery_items = GalleryItem::where('status', 1)->where('gallery_id', $gallery->id)->get();
        $events = Page::where('slug', 'Like', 'events')->first();
        $settings = Setting::first();
        return view('pages.frontend.gallery.single', compact('gallery', 'settings', 'events', 'gallery_items'));
    }

    public function showAllProducts()
    {
        $products = Product::where('status', 1)->orderBy('order', 'ASC')->get();
        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $subCategories = SubCategory::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $colors = Color::where('status', 1)->get();

        $mainCategory = '';

        return view('pages.frontend.products.index', compact('products', 'brands', 'categories', 'subCategories', 'sizes', 'colors', 'mainCategory'));
    }

    public function viewProduct($slug)
    {
        $product = Product::with(['gallery', 'brand', 'category', 'subCategory'])->where('slug', $slug)->where('status', 1)->firstOrFail();
        return view('pages.frontend.products.single', compact('product'));
    }

    public function viewCategory($cat_slug)
    {
        $mainCategory = Category::where('slug', $cat_slug)->where('status', 1)->firstOrFail();

        $products = Product::where('category_id', $mainCategory->id)
            ->where('status', 1)
            ->orderBy('order', 'ASC')
            ->get();

        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $subCategories = SubCategory::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $colors = Color::where('status', 1)->get();

        return view('pages.frontend.products.index', compact('products', 'brands', 'categories', 'subCategories', 'sizes', 'colors', 'mainCategory', 'categories'));
    }

    public function viewSubCategory($cat_slug, $cat_sub_slug)
    {
        $mainCategory = Category::where('slug', $cat_slug)->where('status', 1)->firstOrFail();
        $subCategory = SubCategory::where('slug', $cat_sub_slug)->where('category_id', $mainCategory->id)->where('status', 1)->firstOrFail();

        $products = Product::where('category_id', $mainCategory->id)
            ->where('sub_category', $subCategory->id)
            ->where('status', 1)
            ->orderBy('order', 'ASC')
            ->get();

        //dd($mainCategory->id,$subCategory->id);

        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $subCategories = SubCategory::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $colors = Color::where('status', 1)->get();

        return view('pages.frontend.products.index', compact('products', 'brands', 'categories', 'subCategories', 'sizes', 'colors', 'mainCategory', 'subCategory', 'categories'));
    }

    public function ajaxView($id, $code)
    {
        $product = Product::where('id', $id)
            ->where('product_code', $code)
            ->first();

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json([
            'title' => $product->title,
            'description' => $product->description,
            'price' => number_format($product->price, 2),
            'feature_image' => url('public/assets/uploads/products/' . $product->feature_image),
            'qty' => $product->qty,
        ]);
    }


    public function fetchProducts(Request $request)
    {
        $products = Product::query()->where('status', 1);

        // Filters
        if ($request->filled('size')) {
            $products->whereHas('sizes', fn($q) => $q->where('sizes.id', $request->size));
        }

        if ($request->filled('color')) {
            $products->whereHas('colors', fn($q) => $q->where('colors.id', $request->color));
        }

        if ($request->filled('category_id')) {
            $products->whereIn('category_id', $request->category_id);
        }

        if ($request->filled('brand_id')) {
            $products->whereIn('brand_id', $request->brand_id);
        }

        if ($request->filled('subcategory_id')) {
            $products->where('sub_category', $request->subcategory_id);
        }

        if ($request->filled('price_range')) {
            [$min, $max] = explode('-', $request->price_range);
            $products->whereBetween('price', [(int) $min, (int) $max]);
        }

        $products = $products->orderBy('order', 'ASC')->get();

        $html = view('partials.product_list', compact('products'))->render();

        return response()->json(['success' => true, 'html' => $html]);
    }

    public function cartProducts()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home.index')->with('error', 'Your cart is empty.');
        }
        return view('pages.frontend.cart.index', compact('cart'));
    }

    public function updateCartQuantity(Request $request)
    {
        $productId = $request->product_id;
        $action = $request->action;
        $cart = session()->get('cart', []);

        if (!isset($cart[$productId])) {
            return response()->json(['message' => 'Product not found in cart.'], 404);
        }

        if ($action === 'increment') {
            // You can check product stock limit here if needed
            $cart[$productId]['quantity']++;
        } elseif ($action === 'decrement') {
            $cart[$productId]['quantity']--;

            if ($cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]); // remove item if 0
            }
        } else {
            return response()->json(['message' => 'Invalid action.'], 400);
        }

        session()->put('cart', $cart);

        return response()->json(['message' => 'Cart updated successfully.']);
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home.index')->with('error', 'Your cart is empty.');
        }
        $category = Category::where('status', 1)->get();
        $products = Product::where('status', 1)->orderBy('order', 'ASC')->get();
        $countries = Country::where('status', 1)->get();
        $districts = District::where('status', 1)->get();
        $settings = Setting::first();

        return view('pages.frontend.checkout.index', compact('cart', 'countries', 'settings', 'category', 'products', 'districts'));
    }

    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'empty_user',
                'message' => 'You must be logged in to add products to the cart.'
            ]);
        }
        $parts = explode('/', $request->product_info);
        $productId = $parts[0];

        $product = Product::findOrFail($productId);

        // Get current cart from session
        $cart = session()->get('cart', []);

        // Get existing quantity in cart for this product, or 0 if not in cart
        $existingQty = isset($cart[$productId]) ? $cart[$productId]['quantity'] : 0;

        // Calculate how many more can be added (product stock - 5 buffer)
        $availableQty = $product->qty - 5;

        // Restrict adding to cart if limit reached
        if ($availableQty <= $existingQty) {
            return response()->json([
                'message' => 'This product is currently low in stock and cannot be added to cart.',
                'total_qty' => collect($cart)->sum('quantity'),
                'status' => 'error'
            ], 400);
        }

        // If already in cart, increment quantity
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'product_code' => $product->product_code,
                'title' => $product->title,
                'price' => $product->discount > 0
                    ? $product->price - ($product->price * $product->discount / 100)
                    : $product->price,
                'image' => $product->feature_image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        // Calculate total quantity in cart
        $totalQty = collect($cart)->sum('quantity');

        return response()->json([
            'message' => $product->title . ' added to cart!',
            'total_qty' => $totalQty ?? 0,
            'status' => 'success'
        ]);
    }

    // public function clearCart()
    // {
    //     session()->forget('cart');

    //     return redirect()->back()->with('success', 'Cart cleared successfully.');
    // }

    public function remove_item($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return response()->json(['status' => 'success', 'message' => 'Item removed from cart successfully.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Item not found in cart.'], 404);
    }

    public function emptyCart()
    {
        session()->forget('cart');
        return response()->json(['status' => 'success', 'message' => 'Cart has been emptied successfully.']);
    }

    public function fetchCartQty()
    {
        //session()->forget('cart');
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            $totalQty = 0;
        } else {
            $totalQty = collect($cart)->sum('quantity');
        }

        return response()->json(['total_qty' => $totalQty]);
    }

    public function getShippingCharge($districtId)
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = ShippingCharge::where('district_id', $districtId)->value('charge') ?? 0;
        $total = $subtotal + $shipping;

        return response()->json([
            'shipping' => number_format($shipping, 2),
            'subtotal' => number_format($subtotal, 2),
            'total' => number_format($total, 2),
        ]);
    }

    public function createStripeIntent(Request $request)
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = ShippingCharge::where('district_id', $request->district)->value('charge') ?? 0;
        $total = $subtotal + $shipping;

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $intent = PaymentIntent::create([
            'amount' => $total * 100,
            'currency' => 'lkr',
            'payment_method_types' => ['card']
        ]);

        return response()->json(['client_secret' => $intent->client_secret]);
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart))
            return response()->json(['error' => 'Cart is empty'], 422);

        $subtotal = 0;
        $qty = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
            $qty += $item['quantity'];
        }

        $shipping = ShippingCharge::where('district_id', $request->district)->value('charge') ?? 0;
        $total = $subtotal + $shipping;
        do {
            $orderId = rand(100000, 999999);
        } while (Order::where('order_id', $orderId)->exists());

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'order_id' => $orderId,
            'amount' => $subtotal,
            'qty' => $qty,
            'total' => $total,
            'payment_method' => '' . strtoupper($request->payment_method) . '',
            'notes' => $request->different_address ? $request->other_address : '',
            'confirmation' => 1,
            'address' => $request->different_address ? $request->other_address : $request->address,
            'city' => $request->city ?? '',
            'district' => $request->district,
            'status' => $request->payment_method === 'stripe' ? 'pending' : 'completed',
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_code' => $item['product_code'],
                'amount' => $item['price'],
                'qty' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
                'status' => 'pending'
            ]);
            // Reduce product stock
            Product::where('id', $id)->decrement('qty', $item['quantity']);
        }


        $user = auth()->user();
        $message = "Hi {$user->name},\nThank you for your order.\nOrder ID: {$order->order_id}\nTotal: Rs. {$total}\nWe will process your order soon.\n\nThanks,\nEcommerce Team";

        SmsHelper::send($user->phone, $message);

        session()->forget('cart');
        return response()->json(['success' => true, 'order_id' => $order->order_id]);
    }


    public function getCheckoutData(Request $request)
    {
        $cart = session()->get('cart', []);
        $cart_items = [];
        $subtotal = 0;

        $district_id = $request->input('district_id') ?? '';

        if ($district_id) {
            $shipping = ShippingCharge::where('district_id', $district_id)->value('charge') ?? 0;
        } else {
            $shipping = 0; // Default shipping if no district selected
        }

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $item_total = $item['price'] * $item['quantity'];
                $subtotal += $item_total;

                $cart_items[] = [
                    'id' => $id,
                    'title' => $item['title'],
                    'quantity' => $item['quantity'],
                    'price' => number_format($item['price'], 2),
                    'total_price' => number_format($item_total, 2),
                ];
            }

        }

        $total = $subtotal + $shipping;

        return response()->json([
            'cart_items' => $cart_items,
            'subtotal' => number_format($subtotal, 2),
            'shipping' => number_format($shipping, 2),
            'total' => number_format($total, 2),
        ]);
    }

    public function fetchCart()
    {
        //session()->forget('cart');
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            $cart_items = [];
        } else {
            $cart_items = [];
            foreach ($cart as $id => $item) {
                $product = Product::find($id);
                if ($product) {
                    $cart_items[] = [
                        'id' => $id,
                        'product_code' => $item['product_code'],
                        'title' => $item['title'],
                        'price' => number_format($item['price'], 2),
                        'image' => url('public/assets/uploads/products/' . $item['image']),
                        'quantity' => $item['quantity'],
                        'total_price' => number_format($item['price'] * $item['quantity'], 2),
                    ];
                }
            }
        }

        return response()->json(['cart_items' => $$cart_items]);
    }

    public function fetchCartDetails()
    {
        $cart_html = '';
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return '';
        }

        $total_amount = 0;

        foreach (array_slice($cart, 0, 5) as $item) {
            $total_amount += $item['price'] * $item['quantity'];

            $cart_html .= '<li>
                <div class="cart-item d-flex align-items-center">
                    <img src="' . asset('public/assets/uploads/products/' . $item['image']) . '" width="40" alt="' . e($item['title']) . '" class="mr-2">
                    <div>
                        <strong>' . e($item['title']) . '</strong><br>
                        Qty: ' . e($item['quantity']) . '<br>
                        Price: Rs. ' . number_format($item['price'], 2) . '
                    </div>
                </div>
            </li>';
        }
        $cart_html .= '<li class="d-flex justify-content-between mt-2">
            <p><strong>Total: </strong></p>
            <p><strong>Rs. ' . number_format($total_amount, 2) . '</strong></p>
        </li>';
        $cart_html .= '<li class="d-flex mt-2">
            <a href="' . route('frontend.cart') . '" class="genric-btn primary circle arrow w-50 text-center p-0 mr-2">Cart</a>
            <a href="#" class="genric-btn danger circle arrow w-50 text-center p-0" id="empty_cart">Clear All</a>
        </li>';
        $cart_html .= '<li class="mt-2">
            <a href="' . route('frontend.checkout') . '" class="genric-btn info circle arrow w-100 text-center" id="checkout">Checkout</a>
        </li>';

        return $cart_html;
    }


    public function showArticles()
    {
        $blogs = Blog::where('status', 1)
            ->where('blog_type', 'blogs-article')
            ->latest()
            ->get();

        $page_blog = Page::where('slug', 'Like', 'blogs')->first();
        $blog_type = 'Blogs & Article';
        return view('pages.frontend.blogs.index', compact('blogs', 'blog_type', 'page_blog'));
    }

    public function showNews()
    {
        $blogs = Blog::where('status', 1)
            ->where('blog_type', 'news-events')
            ->latest()
            ->get();

        $page_blog = Page::where('slug', 'Like', 'blogs')->first();

        $blog_type = 'News & Events';

        return view('pages.frontend.blogs.index', compact('blogs', 'blog_type', 'page_blog'));
    }

    public function viewArticle($slug)
    {
        $blog = Blog::with('author') // Eager load author
            ->where('slug', $slug)
            ->where('status', 1)
            ->where('blog_type', 'blogs-article')
            ->firstOrFail();

        $page_blog = Page::where('slug', 'like', 'blogs')->first();
        $recent_blogs = Blog::where('slug', '!=', $slug)->where('status', 1)->where('blog_type', 'blogs-article')->latest()->take(5)->get();

        // Get Previous Blog
        $prev_blog = Blog::where('id', '<', $blog->id)
            ->where('status', 1)
            ->where('blog_type', 'blogs-article')
            ->orderBy('id', 'desc')
            ->first();

        // Get Next Blog
        $next_blog = Blog::where('id', '>', $blog->id)
            ->where('status', 1)
            ->where('blog_type', 'blogs-article')
            ->orderBy('id', 'asc')
            ->first();

        //dd($blog->id);

        return view('pages.frontend.blogs.single', compact('blog', 'page_blog', 'recent_blogs', 'prev_blog', 'next_blog'));
    }

    public function viewNews($slug)
    {
        $blog = Blog::where('slug', $slug)->where('status', 1)->where('blog_type', 'news-events')->firstOrFail();
        $page_blog = Page::where('slug', 'Like', 'blogs')->first();
        return view('pages.frontend.blogs.single', compact('blog', 'page_blog'));
    }

}
