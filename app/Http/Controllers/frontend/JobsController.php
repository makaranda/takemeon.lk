<?php

namespace App\Http\Controllers\frontend;

use App\Helpers\SmsHelper;
use App\Http\Controllers\Controller;
use App\Models\EmpSubCategory;
use App\Models\EmpMainCategory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingCharge;
use App\Models\User;
use App\Models\EmpDesignation;
use App\Models\EmpIndustry;
use App\Models\Province;
use App\Models\District;
use App\Models\DistrictCity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class JobsController extends Controller
{
    public function showAllJobs()
    {
        $jobs = User::where('status', 1)->orderBy('created_at', 'ASC')->get();
        //$users = User::with(['detail', 'socialLinks','expectingArea','UserEducation','schoolLevel','professionalDetail','pastEmployments'])->find(Auth::id());
       
        $designations = EmpDesignation::where('status',1)->get(); 
        $industries = EmpIndustry::where('status',1)->get();  
        $categories = EmpMainCategory::where('status',1)->get();  
        $subCategories = EmpSubCategory::where('status',1)->get();  
        $provinces = Province::where('status',1)->get();  
        $districts = District::where('status',1)->get();  
        $districtCities = DistrictCity::where('status',1)->get(); 

        $mainCategory = '';

        return view('pages.frontend.jobs.index', compact('jobs', 'designations', 'industries', 'categories', 'subCategories', 'provinces', 'districts','districtCities','mainCategory'));
    }

    public function viewJob($slug)
    {
        $job = User::with(['detail', 'socialLinks','expectingArea','UserEducation','schoolLevel','professionalDetail','pastEmployments'])->where('slug', $slug)->where('status', 1)->firstOrFail();
        return view('pages.frontend.jobs.single', compact('job'));
    }

    public function viewCategory($cat_slug)
    {
        $mainCategory = EmpMainCategory::where('slug', $cat_slug)->where('status', 1)->firstOrFail();

        $jobs = User::where('category_id', $mainCategory->id)
            ->where('status', 1)
            ->orderBy('created_at', 'ASC')
            ->get();

        $designations = EmpDesignation::where('status',1)->get(); 
        $industries = EmpIndustry::where('status',1)->get();  
        $categories = EmpMainCategory::where('status',1)->get();  
        $subCategories = EmpSubCategory::where('status',1)->get();  
        $provinces = Province::where('status',1)->get();  
        $districts = District::where('status',1)->get();  
        $districtCities = DistrictCity::where('status',1)->get(); 

        return view('pages.frontend.jobs.index', compact('jobs', 'designations', 'industries', 'categories', 'subCategories', 'provinces', 'districts','districtCities'));
    }

    public function viewSubCategory($cat_slug, $cat_sub_slug)
    {
        $mainCategory = EmpMainCategory::where('slug', $cat_slug)->where('status', 1)->firstOrFail();
        $subCategory = EmpSubCategory::where('slug', $cat_sub_slug)->where('category_id', $mainCategory->id)->where('status', 1)->firstOrFail();

        $jobs = User::where('category_id', $mainCategory->id)
            ->where('sub_category', $subCategory->id)
            ->where('status', 1)
            ->orderBy('created_at', 'ASC')
            ->get();

        //dd($mainCategory->id,$subCategory->id);

        $designations = EmpDesignation::where('status',1)->get(); 
        $industries = EmpIndustry::where('status',1)->get();  
        $categories = EmpMainCategory::where('status',1)->get();  
        $subCategories = EmpSubCategory::where('status',1)->get();  
        $provinces = Province::where('status',1)->get();  
        $districts = District::where('status',1)->get();  
        $districtCities = DistrictCity::where('status',1)->get(); 

        $mainCategory = '';

        return view('pages.frontend.jobs.index', compact('jobs', 'designations', 'industries', 'categories', 'subCategories', 'provinces', 'districts','districtCities','mainCategory'));
    }

    public function ajaxView($id, $slug)
    {
        // $job = User::where('id', $id)
        //     ->where('slug', $slug)
        //     ->first();
        $job = User::with(['detail', 'socialLinks','expectingArea','UserEducation','schoolLevel','professionalDetail','pastEmployments'])->where('id', $id)->where('slug', $slug)->where('status', 1)->firstOrFail();    

        if (!$job) {
            return response()->json(['error' => 'Candidate not found'], 404);
        }

        return response()->json([
            'title' => $job->name,
            'phone' => $job->detail->phone,
            //'price' => number_format($job->price, 2),
            'feature_image' => url('public/assets/frontend/candidates/' . $job->detail->profile_img),
        ]);
    }


    public function fetchJobs(Request $request)
    {
        $query = User::with([
            'detail',
            'socialLinks',
            'expectingArea',
            'userEducation',
            'schoolLevel',
            'professionalDetail',
            'pastEmployments'
        ])->where('status', 1)
        ->where('role', 'candidate'); // important

        // 🔎 Filter by Province
        if ($request->filled('province_id')) {
            $query->whereHas('expectingArea', function ($q) use ($request) {
                $q->where('province_id', $request->province_id);
            });
        }

        // 🔎 Filter by District
        if ($request->filled('district_id')) {
            $query->whereHas('expectingArea', function ($q) use ($request) {
                $q->where('district_id', $request->district_id);
            });
        }

        // 🔎 Filter by Education
        if ($request->filled('education_level')) {
            $query->whereHas('userEducation', function ($q) use ($request) {
                $q->where('level', $request->education_level);
            });
        }

        // 🔎 Filter by Professional Category
        if ($request->filled('category_id')) {
            $query->whereHas('professionalDetail', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        // 🔎 Filter by Keyword Search
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                ->orWhere('username', 'like', '%' . $request->keyword . '%');
            });
        }

        $jobs = $query->orderBy('created_at', 'desc')->get();

        $html = view('partials.jobs_list', compact('jobs'))->render();

        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }
}
