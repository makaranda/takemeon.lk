<?php

use Illuminate\Support\Facades\Route;

/** Frontend Controllers */
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\PaymentController;
use App\Http\Controllers\frontend\CustomerDashboardController;

/** Admin Controllers */
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CustomersController;
use App\Http\Controllers\admin\MusicTracksController;
use App\Http\Controllers\admin\MainSliderController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\admin\ProductGalleryController;
use App\Http\Controllers\admin\ProgrammesController;
use App\Http\Controllers\admin\StudyAbroadController;
use App\Http\Controllers\admin\UniversitiesController;
use App\Http\Controllers\admin\AccordingsController;
use App\Http\Controllers\admin\BlogsController;
use App\Http\Controllers\admin\CareersController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\GalleryItemController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\GalleryHomeController;
use App\Http\Controllers\admin\HomeSectionVideoController;
use App\Http\Controllers\admin\HomeSectionPartnersController;
use App\Http\Controllers\admin\HomeSectionAccordingController;
use App\Http\Controllers\admin\CKEditorController;
use App\Http\Controllers\admin\UploadsController;


use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your apfrontend.useplication. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Route::get('/', [HomeController::class, 'construction'])->name('home.construction');
Route::get('/', [HomeController::class, 'index'])->name('home.index');
//Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin-login', [AuthController::class, 'index'])->name('admin.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::get('/customer-logout', [AuthController::class, 'customerLogout'])->name('customer.logout');
Route::post('/admin-login', [AuthController::class, 'login'])->name('admin.loginform');

Route::get('/user-login', [AuthController::class, 'userLogin'])->name('frontend.userlogin');
Route::get('/user-logout', [AuthController::class, 'userLogout'])->name('frontend.userlogout');
Route::post('/user-login', [AuthController::class, 'userLoginSubmit'])->name('frontend.userloginform');
Route::get('/user-register', [AuthController::class, 'userRegister'])->name('frontend.userregister');
Route::post('/user-register', [AuthController::class, 'userRegisterSubmit'])->name('frontend.userregisterform');
Route::post('/user-reset-password', [AuthController::class, 'userResetPassword'])->name('frontend.userresetpassword');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('frontend.verifyotp');


// Frontend Routes
Route::get('/pay-online', [HomeController::class, 'payOnline'])->name('frontend.payonline');
Route::get('/enroll', [HomeController::class, 'enroll'])->name('frontend.enroll.now');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('frontend.contact');
Route::post('/contact-submit', [HomeController::class, 'contactSubmit'])->name('frontend.contactsubmit');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('frontend.about');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('frontend.gallery');
Route::get('/privacy-and-policy', [HomeController::class, 'privacyPolicy'])->name('frontend.privacypolicy');
Route::get('/terms-and-conditions', [HomeController::class, 'termsAndConditions'])->name('frontend.termsandconditions');
Route::get('/faq', [HomeController::class, 'faq'])->name('frontend.faq');
Route::get('/support', [HomeController::class, 'support'])->name('frontend.support');
// Route::get('/music-tracks', [HomeController::class, 'musicTracks'])->name('frontend.musictracks');
// Route::get('/music-videos', [HomeController::class, 'musicVideos'])->name('frontend.musicvideos');

// Dynamic Page Routes
Route::get('page/{slug?}', [HomeController::class, 'dynamicPage'])->name('frontend.page')->defaults('slug', 'home');

// Products Routes
Route::prefix('/products')->group(function () {
    Route::get('/', [HomeController::class, 'showAllProducts'])->name('frontend.home.products');
    Route::get('/fetch-products', [HomeController::class, 'fetchProducts'])->name('frontend.product.fetch');
    Route::get('/categories/{cat_slug}', [HomeController::class, 'viewCategory'])->name('frontend.product.category');
    Route::get('/categories/{cat_slug}/{cat_sub_slug}', [HomeController::class, 'viewSubCategory'])->name('frontend.product.subcategory');
    Route::get('/{slug}', [HomeController::class, 'viewProduct'])->name('frontend.product.view');
    Route::get('/view/{id}/{code}', [HomeController::class, 'ajaxView'])->name('frontend.product.ajaxview');
});


Route::get('/cart', [HomeController::class, 'cartProducts'])->name('frontend.cart');
Route::post('/add-to-cart', [HomeController::class, 'addToCart'])->name('frontend.cart.add');
Route::get('/fetch-cart-qty', [HomeController::class, 'fetchCartQty'])->name('frontend.fetchcartqty');
Route::get('/fetch-carts', [HomeController::class, 'fetchCartDetails'])->name('frontend.fetchcartdetails');
Route::get('/fetch-cart-items', [HomeController::class, 'fetchCart'])->name('frontend.fetchcart');
Route::get('/cart/clear', [HomeController::class, 'emptyCart'])->name('frontend.cart.clear');
Route::get('/cart/remove/{id}', [HomeController::class, 'removeCartItem'])->name('frontend.cart.remove');
Route::post('/cart/update', [HomeController::class, 'updateCartQuantity'])->name('frontend.cart.update');

Route::prefix('/checkout')->group(function () {
    Route::get('/', [HomeController::class, 'checkout'])->name('frontend.checkout');
    Route::get('/fetch-checkout-data', [HomeController::class, 'getCheckoutData'])->name('frontend.checkout.data');
    Route::get('/shipping-charge/{district}', [HomeController::class, 'getShippingCharge'])->name('frontend.checkout.shippingcharge');
    Route::get('/store', [HomeController::class, 'store'])->middleware('auth')->name('frontend.checkout.store');
    Route::post('/stripe/payment-intent', [HomeController::class, 'createStripeIntent'])->name('frontend.stripe.intent');
    //Route::get('/{slug}', [HomeController::class, 'viewNews'])->name('frontend.news.events.view');
});

// Blogs Routes
Route::prefix('/blogs')->group(function () {
    Route::get('/', [HomeController::class, 'showArticles'])->name('frontend.home.blogs');
    Route::get('/{slug}', [HomeController::class, 'viewArticle'])->name('frontend.blogs.article.view');
    //Route::get('/{slug}', [HomeController::class, 'viewNews'])->name('frontend.news.events.view');
});

// Events Routes
Route::prefix('/events')->group(function () {
    Route::get('/', [HomeController::class, 'showEvents'])->name('frontend.home.events');
    Route::get('/{slug}', [HomeController::class, 'viewEvent'])->name('frontend.events.singleview');
});

// Events Routes
Route::prefix('/careers')->group(function () {
    Route::get('/', [HomeController::class, 'showCareers'])->name('frontend.home.careers');
    Route::get('/{slug}', [HomeController::class, 'viewCareer'])->name('frontend.careers.singleview');
});

//Route::get('/blogs-article', [HomeController::class, 'showArticles'])->name('frontend.blogs.article');
//Route::get('/news-events', [HomeController::class, 'showNews'])->name('frontend.news.events');
//Route::get('/blogs-article/{slug}', [HomeController::class, 'viewArticle'])->name('frontend.blogs.article.view');
//Route::get('/news-events/{slug}', [HomeController::class, 'viewNews'])->name('frontend.news.events.view');

// Optional: For individual blog display
// Route::prefix('programmes')->group(function () {
//     Route::get('/', [HomeController::class, 'programmes'])->name('frontend.programmes');
//     Route::get('/{slug}', [HomeController::class, 'programmeCategories'])->name('frontend.programme.category');
//     Route::get('/{slug}/{sub_slug}', [HomeController::class, 'programmeSubCategories'])->name('frontend.programme.subcategory');
//     Route::get('/{slug}/{sub_slug}/{sub_sub_slug}', [HomeController::class, 'programmeItem'])->name('frontend.programme.programmeitem');
// });

// Study Abroad Routes
Route::prefix('study-abroad')->group(function () {
    Route::get('/', [HomeController::class, 'studyAbroad'])->name('frontend.studyabroad');
    Route::get('/{slug}', [HomeController::class, 'studyAbroadUniversities'])->name('frontend.studyabroad.university');
});

// Payments Route
Route::get('/payment', [PaymentController::class, 'showForm'])->name('payment');
Route::post('/submit-payment', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::post('/receipt', [PaymentController::class, 'handleReceipt'])->name('payment.receipt');


// Route::get('/home', function () {
// Route::get('page/{slug}', function() {
//     return "Page slug is " . request()->slug;
// });

// Customer Dashboard
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/customer-dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::prefix('customer-dashboard')->group(function () {
        Route::post('/user-profile-update{user_id}', [CustomerDashboardController::class, 'userProfileUpdate'])->name('frontend.userprofile.update');
    });
});
// Admin Dashboard
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('dashboard')->group(function () {
        // User routes
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.users');  // Show users list
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.edituser');  // Edit user
            Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('admin.deleteuser');  // Delete user
            Route::get('/add', [UserController::class, 'add'])->name('admin.adduser');  // Add user form
            Route::post('/update/{id}', [UserController::class, 'update'])->name('admin.updateuser');
            Route::post('/save', [UserController::class, 'save'])->name('admin.saveuser');  // Save user
        });
        // Study Abroad routes
        Route::prefix('study-abroad')->group(function () {
            Route::get('/', [StudyAbroadController::class, 'index'])->name('admin.studyabroad');  // Show Study Abroad list
            Route::get('/create', [StudyAbroadController::class, 'create'])->name('admin.createstudyabroad');
            Route::post('/store', [StudyAbroadController::class, 'store'])->name('admin.storestudyabroad');
            Route::get('/edit/{id}', [StudyAbroadController::class, 'edit'])->name('admin.editstudyabroad');  // Edit Study Abroad
            Route::delete('/delete/{id}', [StudyAbroadController::class, 'delete'])->name('admin.deletestudyabroad');  // Delete Study Abroad
            Route::post('/update/{id}', [StudyAbroadController::class, 'update'])->name('admin.updatestudyabroad');
            Route::post('/save', [StudyAbroadController::class, 'save'])->name('admin.savestudyabroadk');  // Save Study Abroad

            Route::get('/universities', [UniversitiesController::class, 'index'])->name('admin.universities');
            Route::get('/universities/create', [UniversitiesController::class, 'create'])->name('admin.createuniversity');
            Route::post('/universities/store', [UniversitiesController::class, 'store'])->name('admin.storeuniversity');
            Route::get('/universities/edit/{id}', [UniversitiesController::class, 'edit'])->name('admin.edituniversity');
            Route::post('/universities/update/{id}', [UniversitiesController::class, 'update'])->name('admin.updateuniversity');
            Route::delete('/universities/delete/{id}', [UniversitiesController::class, 'delete'])->name('admin.deleteuniversity');
            Route::post('/universities/update_order/{id}', [UniversitiesController::class, 'updateOrder'])->name('admin.updateorderuniversity');
            Route::post('/universities/update_page_id/{id}', [UniversitiesController::class, 'updatePageID'])->name('admin.updatepageiduniversity');
        });

        // Home Page Section - Video
        Route::prefix('home-section-video')->group(function () {
            Route::get('/{id}', [HomeSectionVideoController::class, 'index'])->name('admin.homesecvideo');  // Show users list
            Route::get('/edit/{id}', [HomeSectionVideoController::class, 'edit'])->name('admin.edithomesecvideo');  // Edit user
            Route::put('/update/{id}', [HomeSectionVideoController::class, 'update'])->name('admin.updatehomesecvideo');
        });
        Route::prefix('home-section-according')->group(function () {
            Route::get('/', [HomeSectionAccordingController::class, 'index'])->name('admin.homesecaccording');  // Show users list
            Route::get('/create', [HomeSectionAccordingController::class, 'create'])->name('admin.createhomesecaccording');
            Route::post('/store', [HomeSectionAccordingController::class, 'store'])->name('admin.storehomesecaccording');
            Route::get('/edit/{id}', [HomeSectionAccordingController::class, 'edit'])->name('admin.edithomesecaccording');  // Edit user
            Route::post('/update/{id}', [HomeSectionAccordingController::class, 'update'])->name('admin.updatehomesecaccording');
            Route::delete('/delete/{id}', [HomeSectionAccordingController::class, 'delete'])->name('admin.deletehomesecaccording');
            Route::post('/update_order/{id}', [HomeSectionAccordingController::class, 'updateOrder'])->name('admin.updateOrderhomesecaccording');
        });
        Route::prefix('home-section-partners')->group(function () {
            Route::get('/', [HomeSectionPartnersController::class, 'index'])->name('admin.homesecpartners');  // Show users list
            Route::get('/create', [HomeSectionPartnersController::class, 'create'])->name('admin.createhomesecpartners');
            Route::post('/store', [HomeSectionPartnersController::class, 'store'])->name('admin.storehomesecpartners');
            Route::get('/edit/{id}', [HomeSectionPartnersController::class, 'edit'])->name('admin.edithomesecpartners');  // Edit user
            Route::post('/update/{id}', [HomeSectionPartnersController::class, 'update'])->name('admin.updatehomesecpartners');
            Route::delete('/delete/{id}', [HomeSectionPartnersController::class, 'delete'])->name('admin.deletehomesecpartners');
            Route::post('/update_order/{id}', [HomeSectionPartnersController::class, 'updateOrder'])->name('admin.updateOrderhomesecpartners');
        });

        // Uploads routes
        Route::prefix('uploads')->group(function () {
            Route::get('/', [UploadsController::class, 'index'])->name('admin.uploads');
            Route::get('/create', [UploadsController::class, 'create'])->name('admin.createupload');
            Route::post('/store', [UploadsController::class, 'store'])->name('admin.storeupload');
            Route::get('/edit/{id}', [UploadsController::class, 'edit'])->name('admin.editupload');
            Route::post('/update/{id}', [UploadsController::class, 'update'])->name('admin.updateupload');
            Route::delete('/delete/{id}', [UploadsController::class, 'delete'])->name('admin.deleteuploade');
        });

        // Pages routes
        Route::prefix('pages')->group(function () {
            Route::get('/', [PagesController::class, 'index'])->name('admin.pages');
            Route::get('/create', [PagesController::class, 'create'])->name('admin.createpage');
            Route::post('/store', [PagesController::class, 'store'])->name('admin.storepage');
            Route::get('/edit/{id}', [PagesController::class, 'edit'])->name('admin.editpage');
            Route::post('/update/{id}', [PagesController::class, 'update'])->name('admin.updatepage');
            Route::delete('/delete/{id}', [PagesController::class, 'delete'])->name('admin.deletepage');
            Route::get('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
        });

        // Products routes
        Route::prefix('products')->group(function () {
            Route::get('/', [ProductsController::class, 'index'])->name('admin.products');
            Route::get('/create', [ProductsController::class, 'create'])->name('admin.createproduct');
            Route::post('/store', [ProductsController::class, 'store'])->name('admin.storeproduct');
            Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('admin.editproduct');
            Route::post('/update/{id}', [ProductsController::class, 'update'])->name('admin.updateproduct');
            Route::delete('/delete/{id}', [ProductsController::class, 'delete'])->name('admin.deleteproduct');
            Route::get('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
            Route::get('/get-subcategories/{category_id}', [ProductsController::class, 'getSubCategories'])->name('get.subcategories');
        });

        // Orders routes
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrdersController::class, 'index'])->name('admin.orders');
            Route::get('/create', [OrdersController::class, 'create'])->name('admin.createorder');
            Route::post('/store', [OrdersController::class, 'store'])->name('admin.storeorder');
            Route::get('/edit/{id}', [OrdersController::class, 'edit'])->name('admin.editorder');
            Route::post('/update/{id}', [OrdersController::class, 'update'])->name('admin.updateorder');
            Route::delete('/delete/{id}', [OrdersController::class, 'delete'])->name('admin.deleteorder');
            Route::get('/fetch-order-items/{id}', [OrdersController::class, 'fetchOrderItems'])->name('admin.fetchorderitems');
            Route::get('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
            Route::get('/get-subcategories/{category_id}', [OrdersController::class, 'getSubCategories'])->name('get.subcategories');
        });

        // Blogs routes
        Route::prefix('customers')->group(function () {
            Route::get('/', [CustomersController::class, 'index'])->name('admin.customers');  // Show users list
            Route::get('/edit/{id}', [CustomersController::class, 'edit'])->name('admin.editcustomer');  // Edit user
            Route::delete('/delete/{id}', [UserCoCustomersControllerntroller::class, 'delete'])->name('admin.deletecustomer');  // Delete user
            Route::get('/add', [CustomersController::class, 'add'])->name('admin.addcustomer');  // Add user form
            Route::post('/update/{id}', [CustomersController::class, 'update'])->name('admin.updatecustomer');
            Route::post('/save', [CustomersController::class, 'save'])->name('admin.savecustomer');
            Route::get('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
        });

        // Blogs routes
        Route::prefix('blogs')->group(function () {
            Route::get('/', [BlogsController::class, 'index'])->name('admin.blogs');
            Route::get('/create', [BlogsController::class, 'create'])->name('admin.createblog');
            Route::post('/store', [BlogsController::class, 'store'])->name('admin.storeblog');
            Route::get('/edit/{id}', [BlogsController::class, 'edit'])->name('admin.editblog');
            Route::post('/update/{id}', [BlogsController::class, 'update'])->name('admin.updateblog');
            Route::delete('/delete/{id}', [BlogsController::class, 'delete'])->name('admin.deleteblog');
            Route::get('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
        });

        // Events routes
        Route::prefix('events')->group(function () {
            Route::get('/', [GalleryController::class, 'index'])->name('admin.events');
            Route::get('/create', [GalleryController::class, 'create'])->name('admin.createevent');
            Route::post('/store', [GalleryController::class, 'store'])->name('admin.storeevent');
            Route::get('/edit/{id}', [GalleryController::class, 'edit'])->name('admin.editevent');
            Route::post('/update/{id}', [GalleryController::class, 'update'])->name('admin.updateevent');
            Route::delete('/delete/{id}', [GalleryController::class, 'delete'])->name('admin.deleteevent');

            Route::get('/items', [GalleryItemController::class, 'index'])->name('admin.events.items');
            Route::get('/items/create', [GalleryItemController::class, 'create'])->name('admin.createevent.items');
            Route::post('/items/store', [GalleryItemController::class, 'store'])->name('admin.storeevent.items');
            Route::get('/items/edit/{id}', [GalleryItemController::class, 'edit'])->name('admin.editevent.items');
            Route::post('/items/update/{id}', [GalleryItemController::class, 'update'])->name('admin.updateevent.items');
            Route::delete('/items/delete/{id}', [GalleryItemController::class, 'delete'])->name('admin.deleteevent.items');

            Route::get('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
        });

        // Careers routes
        Route::prefix('careers')->group(function () {
            Route::get('/', [CareersController::class, 'index'])->name('admin.careers');
            Route::get('/create', [CareersController::class, 'create'])->name('admin.createcareer');
            Route::post('/store', [CareersController::class, 'store'])->name('admin.storecareer');
            Route::get('/edit/{id}', [CareersController::class, 'edit'])->name('admin.editcareer');
            Route::post('/update/{id}', [CareersController::class, 'update'])->name('admin.updatecareer');
            Route::delete('/delete/{id}', [CareersController::class, 'delete'])->name('admin.deletecareer');
            Route::get('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
        });

        // Contact Us routes
        Route::prefix('contacts')->group(function () {
            Route::get('/', [ContactController::class, 'index'])->name('admin.contacts');
            Route::get('/view/{id}', [ContactController::class, 'view'])->name('admin.viewcontact');
            Route::get('/edit/{id}', [ContactController::class, 'edit'])->name('admin.editcontact');
            Route::put('/update/{id}', [ContactController::class, 'update'])->name('admin.updatecontact');
            Route::delete('/delete/{id}', [ContactController::class, 'delete'])->name('admin.deletecontact');
        });
        // Main Slider routes
        Route::prefix('main-slider')->group(function () {
            Route::get('/', [MainSliderController::class, 'index'])->name('admin.mainslider');
            Route::get('/create', [MainSliderController::class, 'create'])->name('admin.createmainslider');
            Route::post('/store', [MainSliderController::class, 'store'])->name('admin.storemainslider');
            Route::get('/edit/{id}', [MainSliderController::class, 'edit'])->name('admin.editmainslider');
            Route::put('/update/{id}', [MainSliderController::class, 'update'])->name('admin.updatemainslider');
            Route::delete('/delete/{id}', [MainSliderController::class, 'delete'])->name('admin.deletemainslider');
            Route::post('/update_order/{id}', [MainSliderController::class, 'updateOrder'])->name('admin.updateordermainslider');
        });
        // Settings routes
        Route::prefix('settings')->group(function () {
            Route::get('/', [SettingController::class, 'edit'])->name('admin.settings'); // Show settings form
            Route::put('/update/{id}', [SettingController::class, 'update'])->name('admin.updatesettings'); // Update settings
        });
        // Gallery Home routes
        Route::prefix('gallery-home')->group(function () {
            Route::get('/', [GalleryHomeController::class, 'index'])->name('admin.galleryhome');
            Route::get('/add', [GalleryHomeController::class, 'create'])->name('admin.addgalleryhome');
            Route::post('/save', [GalleryHomeController::class, 'store'])->name('admin.savegalleryhome');
            Route::get('/edit/{id}', [GalleryHomeController::class, 'edit'])->name('admin.editgalleryhome');
            Route::post('/update/{id}', [GalleryHomeController::class, 'update'])->name('admin.updategalleryhome');
            Route::delete('/delete/{id}', [GalleryHomeController::class, 'destroy'])->name('admin.deletegalleryhome');
        });

        // Programme routes
        // Route::prefix('programmes')->group(function () {
        //     Route::get('/', [ProgrammesController::class, 'index'])->name('admin.programmes');
        //     Route::get('/create', [ProgrammesController::class, 'create'])->name('admin.createprogramme');
        //     Route::post('/store', [ProgrammesController::class, 'store'])->name('admin.storeprogramme');
        //     Route::get('/edit/{id}', [ProgrammesController::class, 'edit'])->name('admin.editprogramme');
        //     Route::post('/update/{id}', [ProgrammesController::class, 'update'])->name('admin.updateprogramme');
        //     Route::delete('/delete/{id}', [ProgrammesController::class, 'delete'])->name('admin.deleteprogramme');
        //     Route::get('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');
        //     Route::post('/update_order/{id}', [ProgrammesController::class, 'updateOrder'])->name('admin.updateorderprogramme');
        // //var ajax_url = "{{ route('admin.updatepageidprogramme', ':id') }}";

        //     Route::get('/get-subcategories/{category}', [ProgrammesController::class, 'getSubcategories'])->name('admin.getSubcategories');
        //     Route::post('/update_page_id/{id}', [ProgrammesController::class, 'updatePageID'])->name('admin.updatepageidprogramme');

        //     Route::get('/accordings', [AccordingsController::class, 'index'])->name('admin.accordings');
        //     Route::get('/accordings/create', [AccordingsController::class, 'create'])->name('admin.createaccording');
        //     Route::post('/accordings/store', [AccordingsController::class, 'store'])->name('admin.storeaccording');
        //     Route::get('/accordings/edit/{id}', [AccordingsController::class, 'edit'])->name('admin.editaccording');
        //     Route::post('/accordings/update/{id}', [AccordingsController::class, 'update'])->name('admin.updateaccording');
        //     Route::delete('/accordings/delete/{id}', [AccordingsController::class, 'delete'])->name('admin.deleteaccording');
        //     Route::post('/accordings/update_order/{id}', [AccordingsController::class, 'updateOrder'])->name('admin.updateorderaccording');
        //     Route::post('/accordings/update_page_id/{id}', [AccordingsController::class, 'updatePageID'])->name('admin.updatepageidaccording');
        //     Route::post('/accordings/update_section_id/{id}', [AccordingsController::class, 'updateSectionID'])->name('admin.updatesectionidaccording');
        // });
    });
});

// Cache Clear routes
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return "Cache cleared successfully!";
});

// Database Migrate route
Route::get('/artisan-migrate', function () {
    Artisan::call('migrate');

    return "Database migrated successfully!";
});
