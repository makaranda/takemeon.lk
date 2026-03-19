<?php

namespace App\Http\Controllers\frontend;

use App\Helpers\VisitorHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\MainSlider;
use App\Models\MusicTrack;
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
use App\Models\User;
use App\Models\Color;
use App\Models\ProgramCategory;
use App\Models\ProgramSubCategory;
use App\Models\ProgramSubCategoryItem;
use App\Models\Partner;
use App\Models\Blog;
use App\Models\Country;
use App\Models\Link;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
//use App\Observers\VisitorCountObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\UserSocialLink;
use App\Models\UserExpectingArea;
use App\Models\UserEducation;
use App\Models\UserDetail;
use App\Models\UserSchoolLevel;
use App\Models\UserProfessionalDetail;
use App\Models\UserPastEmployment;
use App\Models\EmpDesignation;
use App\Models\EmpIndustry;
use App\Models\EmpMainCategory;
use App\Models\EmpSubCategory;
use App\Models\Province;
use App\Models\District;
use App\Models\DistrictCity;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class CandidateController extends Controller
{
    public function index()
    {
        VisitorHelper::updateVisitorCount();
        //$user = Auth::user();
        //$user = Auth::user()->load(['socialLinks', 'expectingArea']);
        $user = User::with(['detail', 'socialLinks','expectingArea','UserEducation','schoolLevel','professionalDetail','pastEmployments'])->find(Auth::id());
        if (!$user) {
            return redirect()->route('frontend.userlogin')
                ->with('error', 'You must be logged in to access this page.');
        }
        $main_slider = MainSlider::where('status',1)->get(); // Assuming there's only one main slider
        //$music_tracks = MusicTrack::where('status', 1)->where('type','audio')->orderBy('order', 'asc')->orderBy('created_at', 'desc')->take(7)->get();
        //$banner_music_tracks = MusicTrack::where('status', 1)->where('type','audio')->where('order',0)->first();
        //$music_beats = MusicTrack::where('status', 1)->where('type','beat')->orderBy('order', 'asc')->orderBy('created_at', 'desc')->take(7)->get();
        //$video_tracks = MusicTrack::where('status', 1)->where('type','video')->orderBy('order', 'asc')->orderBy('created_at', 'desc')->take(8)->get();
        $about_info = Page::where('slug','LIKE', 'about-us')->where('status', 1)->first(); // Assuming a single about section
        $gallery_home = GalleryHome::where('status', 1)->get();
        $according_home = According::where('status', 1)->where('type', 'home')->orderBy('order','asc')->get();
        $partners_home = Partner::where('status', 1)->orderBy('order','asc')->get();
        $home_sec_video = Page::where('status',1)->where('id',34)->first();
        $random_products = Product::where('status', 1)->inRandomOrder()->take(6)->get();
        $random_blogs = Blog::where('status', 1)->inRandomOrder()->take(3)->get();

        $pending_orders = Order::where('user_id', $user->id)->where('confirmation',1)->where('status', 'pending')->latest()->get();
        $cancel_orders = Order::where('user_id', $user->id)->where('confirmation',1)->where('status', 'cancelled')->latest()->get();
        $complete_orders = Order::where('user_id', $user->id)->where('confirmation',1)->where('status', 'completed')->latest()->get();

        $emp_designations = EmpDesignation::where('status',1)->get(); 
        $emp_industries = EmpIndustry::where('status',1)->get();  
        $emp_main_categories = EmpMainCategory::where('status',1)->get();  
        $emp_sub_categories = EmpSubCategory::where('status',1)->get();  
        $emp_provinces = Province::where('status',1)->get();  
        $emp_districts = District::where('status',1)->get();  
        $emp_district_cities = DistrictCity::where('status',1)->get(); 
        //$admin = Auth::guard('admin')->user();
        //dd($admin);
        // if (!empty($admin->role) && $admin->role > 0) {
        //     return redirect()->route('admin.dashboard');
        // } else {
            return view('pages.frontend.candidatedashboard.index',compact('gallery_home','user','about_info','main_slider','according_home','partners_home','random_products','random_blogs','pending_orders','cancel_orders','complete_orders','emp_designations','emp_industries','emp_main_categories','emp_sub_categories','emp_provinces'));
        //}
    }

    public function userProfileUpdate(Request $request, $user_id)
    {
        //$user = auth()->user(); // secure (ignore passed ID)
        $user = User::where('status',1)->where('id',$user_id)->first();
        $defaultImage = 'user_profile.png';

        if (auth()->id() != $user->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized action.'
            ], 403);
        }

            $user_details = UserDetail::where('user_id',$user_id)->first();

            $profileImgPath  = public_path('assets/frontend/candidates');

            // Create folders if not exist
            if (!File::exists($profileImgPath)) {
                File::makeDirectory($profileImgPath, 0755, true);
            }

            // =========================
            // Profile Upload
            // =========================
            if ($request->hasFile('profile_img') && $request->file('profile_img')->isValid()) {

                $file = $request->file('profile_img');
                $filename = 'profile_img_' . $user_id . '_' . time() . '.' . $file->getClientOriginalExtension();

                // Delete old file
                // if ($user_details && $user_details->profile_img && File::exists($profileImgPath . $user_details->profile_img)) {
                //     File::delete($profileImgPath . $user_details->profile_img);
                // }

                if ($user_details && $user_details->profile_img && $user_details->profile_img !== $defaultImage &&
                    File::exists($profileImgPath . '/' . $user_details->profile_img)
                ) {
                    File::delete($profileImgPath . '/' . $user_details->profile_img);
                }

                $file->move($profileImgPath, $filename);
                //$data['profile_img'] = $filename;
                $user_details->profile_img = $filename;
                $user_details->save();

                return response()->json(['status' => 'success']);
            }
        

        return response()->json(['status' => 'error'], 400);
    }

    public function checkProfileCompleteness(Request $request, $user_id)
    {
        $user = User::where('status', 1)
            ->where('id', $user_id)
            ->with([
                'detail',
                'expectingArea',
                'pastEmployments',
                'professionalDetail'
            ])
            ->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 404);
        }

        if (auth()->id() != $user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $totalFields = 0;
        $completedFields = 0;

        // ----------------------
        // USERS TABLE
        // ----------------------
        $userFields = ['name', 'email', 'phone'];
        foreach ($userFields as $field) {
            $totalFields++;
            if (!empty($user->$field)) {
                $completedFields++;
            }
        }

        // ----------------------
        // USER DETAILS
        // ----------------------
        if ($user->detail) {
            $detailFields = [
                'mobile','phone','state','city',
                'address','dob','nic','sex','profile_img'
            ];

            foreach ($detailFields as $field) {
                $totalFields++;
                if (!empty($user->detail->$field)) {
                    $completedFields++;
                }
            }
        }

        // ----------------------
        // EXPECTING AREAS
        // ----------------------
        if ($user->expectingArea) {
            $expectFields = [
                'job_industry','job_type',
                'job_role','designation','expected_salary'
            ];

            foreach ($expectFields as $field) {
                $totalFields++;
                if (!empty($user->expectingArea->$field)) {
                    $completedFields++;
                }
            }
        }

        // ----------------------
        // PROFESSIONAL DETAILS
        // ----------------------
        if ($user->professionalDetail) {
            $professionalFields = [
                'total_years_experience',
                'skills_summary',
                'about_yourself',
                'designation',
                'current_salary'
            ];

            foreach ($professionalFields as $field) {
                $totalFields++;
                if (!empty($user->professionalDetail->$field)) {
                    $completedFields++;
                }
            }
        }

        // ----------------------
        // PAST EMPLOYMENTS (at least 1 record)
        // ----------------------
        $totalFields++;
        if ($user->pastEmployments && $user->pastEmployments->count() > 0) {
            $completedFields++;
        }

        $percentage = $totalFields > 0
            ? round(($completedFields / $totalFields) * 100)
            : 0;

        return response()->json([
            'status' => true,
            'percentage' => $percentage
        ]);
    }

    public function userProfileDetailsUpdate(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $rules = [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|max:20',
            //'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'dob' => 'nullable|date',
            'nic' => 'nullable|string|max:14',
            'address' => 'nullable|string|max:255',
            //'password' => 'nullable|string|min:6',
            //'confirm_password' => 'nullable|string|same:password',

            'facebook_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'github_link' => 'nullable|url',
        ];

        if ($request->has('update_credentials')) {

            $rules['username'] = 'required|string|max:255|unique:users,username,' . $user->id;
            $rules['password'] = 'nullable|string|min:6';
            $rules['confirm_password'] = 'nullable|string|same:password';

        }

        $request->validate($rules);

        DB::beginTransaction();
        try {
            $user->name = $request->full_name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->phone = $request->phone_number;
            //$user->dob = $request->dob;
            //$user->nic = $request->nic;
            //$user->address = $request->address;

            if ($request->has('update_credentials')) {
                $user->username = $request->username;
            }

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            UserDetail::updateOrCreate(
    ['user_id' => $user->id],
                [
                    'nic'   => $request->nic ?: null,
                    'dob'   => $request->dob ? Carbon::createFromFormat('d M Y', $request->dob)->format('Y-m-d') 
            : null,
                    'address'     => $request->address ?: null,
                    'sex'     => $request->sex ?: null,
                ]
            );

            UserSocialLink::updateOrCreate(
    ['user_id' => $user->id],
                [
                    'facebook_link'   => $request->facebook_link ?: null,
                    'linkedin_link'   => $request->linkedin_link ?: null,
                    'github_link'     => $request->github_link ?: null,
                    'instagrame_link' => $request->instagrame_link ?: null,
                    'twitter_link'    => $request->twitter_link ?: null,
                ]
            );

            $user->load(['detail','socialLinks']);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully!',
                'data' => $user
            ]);
            
        }catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!'.$e
            ], 500);
        }    


    }

    public function userProfileExpectingUpdate(Request $request, $user_id){
        
        $user = User::findOrFail($user_id);
        
        $request->validate([
            'job_industry' => 'nullable',
            'job_type' => 'nullable',
            'designation' => 'nullable',
            'job_role' => 'nullable',
        ]);

        DB::beginTransaction();

        try {
            
            $expectingArea = UserExpectingArea::updateOrCreate(
    ['user_id' => $user->id],
                [
                    'job_industry'   => $request->job_industry ?: null,
                    'job_type'   => $request->job_type ?: null,
                    'job_role'     => $request->job_role ?: null,
                    'designation' => $request->designation ?: null,
                ]
            );

            // $user->job_industry = $request->job_industry;
            // $user->job_type = $request->job_type;
            // $user->job_role = $request->job_role;
            // $user->designation = $request->designation;

            // $user->save();
            DB::commit();


            return response()->json([
                'status' => true,
                'message' => 'Profile Expecting Area updated successfully!',
                'data' => $expectingArea
            ]);
            
        }catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!'
            ], 500);
        }
    }

    public function userEducationUpdate(Request $request, $user_id)
    {
        if (auth()->id() != $user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $request->validate([
            'highest_education_level' => 'nullable|string|max:255',
            'educational_specialization' => 'nullable|string|max:255',
            'institute_university' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {

            $education = UserEducation::updateOrCreate(
                ['user_id' => $user_id],
                [
                    'highest_education_level'   => $request->highest_education_level ?? null,
                    'educational_specialization'=> $request->educational_specialization ?? null,
                    'institute_university'      => $request->institute_university ?? null,
                ]
            );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Education details updated successfully!',
                'data' => $education
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function userSchoolLevelUpdate(Request $request, $user_id)
    {
        if (auth()->id() != $user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $request->validate([
            'ol_school' => 'nullable|string|max:255',
            'ol_year'   => 'nullable|digits:4|integer',
            'al_school' => 'nullable|string|max:255',
            'al_year'   => 'nullable|digits:4|integer',
        ]);

        DB::beginTransaction();

        try {

            $schoolLevel = UserSchoolLevel::updateOrCreate(
                ['user_id' => $user_id],
                [
                    'ol_school' => $request->ol_school ?? null,
                    'ol_year'   => $request->ol_year ?? null,
                    'al_school' => $request->al_school ?? null,
                    'al_year'   => $request->al_year ?? null,
                ]
            );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'School level details updated successfully!',
                'data' => $schoolLevel
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function userProfessionalUpdate(Request $request, $user_id)
    {
        if (auth()->id() != $user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $validated = $request->validate([
            'total_years_experience' => 'nullable|integer|min:0',
            'skills_summary' => 'nullable',
            'about_yourself' => 'nullable|string',
            'current_employer' => 'nullable|string|max:255',
            'current_industry' => 'nullable|string|max:255',
            'current_business_function' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'started_in' => 'nullable|date',
            'notice_period_days' => 'nullable|integer|min:0',
            'about_current_role' => 'nullable|string',
            'current_salary' => 'nullable|numeric|min:0',

            'cv_file' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'nic_front' => 'nullable|image|max:2048',
            'nic_back' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {

            $professional = UserProfessionalDetail::where('user_id', $user_id)->first();
            $data = $validated;
            if ($request->filled('skills_summary')) {

                $skillsInput = $request->skills_summary;

                // Check if it's JSON (Tagify)
                $decoded = json_decode($skillsInput, true);

                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    // Convert Tagify JSON → string
                    $data['skills_summary'] = collect($decoded)
                        ->pluck('value')
                        ->implode(',');
                } else {
                    // Already normal string (manual input fallback)
                    $data['skills_summary'] = $skillsInput;
                }

            } else {
                $data['skills_summary'] = null;
            }
            // =========================
            // FOLDER PATHS
            // =========================
            $nicPath = public_path('assets/frontend/candidates/nic/');
            $cvPath  = public_path('assets/frontend/candidates/cv/');

            // Create folders if not exist
            if (!File::exists($nicPath)) {
                File::makeDirectory($nicPath, 0755, true);
            }

            if (!File::exists($cvPath)) {
                File::makeDirectory($cvPath, 0755, true);
            }

            // =========================
            // CV Upload
            // =========================
            if ($request->hasFile('cv_file') && $request->file('cv_file')->isValid()) {

                $file = $request->file('cv_file');
                $filename = 'cv_' . $user_id . '_' . time() . '.' . $file->getClientOriginalExtension();

                // Delete old file
                if ($professional && $professional->cv_file && File::exists($cvPath . $professional->cv_file)) {
                    File::delete($cvPath . $professional->cv_file);
                }

                $file->move($cvPath, $filename);
                $data['cv_file'] = $filename;
            }

            // =========================
            // NIC Front Upload
            // =========================
            if ($request->hasFile('nic_front') && $request->file('nic_front')->isValid()) {

                $file = $request->file('nic_front');
                $filename = 'nic_front_' . $user_id . '_' . time() . '.' . $file->getClientOriginalExtension();

                if ($professional && $professional->nic_front && File::exists($nicPath . $professional->nic_front)) {
                    File::delete($nicPath . $professional->nic_front);
                }

                $file->move($nicPath, $filename);
                $data['nic_front'] = $filename;
            }

            // =========================
            // NIC Back Upload
            // =========================
            if ($request->hasFile('nic_back') && $request->file('nic_back')->isValid()) {

                $file = $request->file('nic_back');
                $filename = 'nic_back_' . $user_id . '_' . time() . '.' . $file->getClientOriginalExtension();

                if ($professional && $professional->nic_back && File::exists($nicPath . $professional->nic_back)) {
                    File::delete($nicPath . $professional->nic_back);
                }

                $file->move($nicPath, $filename);
                $data['nic_back'] = $filename;
            }

            $data['user_id'] = $user_id;

            $professional = UserProfessionalDetail::updateOrCreate(
                ['user_id' => $user_id],
                $data
            );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Professional details updated successfully!',
                'data' => $professional
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updatePastEmploymentUpdate(Request $request, $user_id)
    {
        if (auth()->id() != $user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $request->validate([
            'company_name'      => 'required|string|max:255',
            'role'              => 'required|string|max:255',
            'employee_category' => 'required|string|max:255',
            'industry'          => 'nullable|string|max:255',
            'start_date'        => 'required|date',
            'end_date'          => 'nullable|date|after_or_equal:start_date',
            'about_role'        => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $schoolLevel = UserPastEmployment::updateOrCreate(
                ['user_id' => $user_id],
                [
                    'company_name' => $request->company_name,
                    'role'   => $request->role,
                    'employee_category' => $request->employee_category,
                    'industry'   => $request->industry ?? null,
                    'start_date'   => $request->start_date,
                    'end_date'   => $request->end_date ?? null,
                    'about_role'   => $request->about_role ?? null,
                ]
            );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Past Employment details updated successfully!',
                'data' => $schoolLevel
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function fetchPastEmployement($user_id)
    {
        // Security check
        if ($user_id != Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $employments = UserPastEmployment::where('user_id', $user_id)
                        ->latest()
                        ->get();

        return response()->json([
            'status' => true,
            'data' => $employments
        ]);
    }

    public function detailsPastEmployement(Request $request,$user_id)
    {
        // Security check
        if ($user_id != Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        // $employments = UserPastEmployment::where('user_id', $user_id)
        //                 ->where('id',$request->emp_id)
        //                 ->latest()
        //                 ->first();

        $employments = UserPastEmployment::with([
                    'industry',
                    'designation',
                    'category'
                ])
                ->where('user_id', $user_id)
                ->where('id', $request->emp_id)
                ->latest()
                ->first();                

        return response()->json([
            'status' => true,
            'data' => $employments
        ]);
    }

    public function addPastEmployement(Request $request)
    {
        $user_id = $request->user_id;
        if (auth()->id() != $user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action.'.$user_id.' - '.Auth::id()
            ], 403);
        }

        $request->validate([
            'company_name'      => 'required|string|max:255',
            'designation_id'    => 'required|string|max:255',
            'category_id'       => 'required|string|max:255',
            'industry_id'       => 'nullable|string|max:255',
            'add_start_date'    => 'required|date',
            'add_end_date'      => 'nullable|date|after_or_equal:add_start_date',
            'about_role'        => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $employment = UserPastEmployment::create([
                'user_id'           => $user_id,
                'company_name'      => $request->company_name,
                'role'              => $request->designation_id,
                'employee_category' => $request->category_id,
                'industry'          => $request->industry_id,
                'start_date'        => $request->add_start_date,
                'end_date'          => $request->add_end_date,
                'about_role'        => $request->about_role,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Past Employment details added successfully!',
                'data' => $employment
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updatePastEmployement(Request $request, $user_id)
    {
        if (auth()->id() != $user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $request->validate([
            'emp_id'            => 'required|exists:user_past_employments,id',
            'company_name'      => 'required|string|max:255',
            'designation_id'    => 'required|integer|exists:emp_designations,id',
            'category_id'       => 'required|integer|exists:emp_main_categories,id',
            'industry_id'       => 'nullable|integer|exists:emp_industries,id',
            'add_start_date'    => 'required|date',
            'add_end_date'      => 'nullable|date|after_or_equal:add_start_date',
            'about_role'        => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $employment = UserPastEmployment::where('id', $request->emp_id)
                            ->where('user_id', $user_id)
                            ->first();

            if (!$employment) {
                return response()->json([
                    'status' => false,
                    'message' => 'Employment record not found.'
                ], 404);
            }

            $employment->update([
                'company_name'      => $request->company_name,
                'role'              => $request->designation_id,
                'employee_category' => $request->category_id,
                'industry'          => $request->industry_id,
                'start_date'        => $request->add_start_date,
                'end_date'          => $request->add_end_date,
                'about_role'        => $request->about_role,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Past Employment details updated successfully!',
                'data' => $employment
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deletePastEmployement(Request $request,$user_id){
        if ($user_id != Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access '
            ], 403);
        }

        $emp_id = $request->emp_id;

            $employment = UserPastEmployment::where('id', $emp_id)
                            ->where('user_id', $user_id)
                            ->first();

            if (!$employment) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized access or record not found.'
                ], 403);
            }

            $employment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Past employment deleted successfully!',
            'data' => $employment
        ]);

    }

    public function checkPastEmployement(Request $request, $user_id)
    {
        if ($user_id != Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access '
            ], 403);
        }

        // $empId = $request->empId ?? '';
        $empId = $request->input('empId', '');
        $employment = null;

        if (!empty($empId)) {
            $employment = UserPastEmployment::where('id', $empId)
                            ->where('user_id', $user_id)
                            ->first();
        }

        $company_name = $employment->company_name ?? '';
        $start_date   = $employment->start_date ?? '';
        $end_date     = $employment->end_date ?? '';
        $about_role   = $employment->about_role ?? '';

        $selectedRole     = $employment->role ?? '';
        $selectedCategory = $employment->employee_category ?? '';
        $selectedIndustry = $employment->industry ?? '';

        $empDesignations = EmpDesignation::where('status', 1)->orderBy('order')->get();
        $empIndustries   = EmpIndustry::where('status', 1)->orderBy('order')->get();
        $empMainCategory = EmpMainCategory::where('status', 1)->orderBy('order')->get();

        //Build Designation Dropdown
        $designationList = '<option value="">--- Select ---</option>';
        foreach ($empDesignations as $designation) {
            $selected = ($selectedRole == $designation->id) ? 'selected' : '';
            $designationList .= '<option value="'.$designation->id.'" '.$selected.'>'.$designation->name.'</option>';
        }

        //Build Industry Dropdown
        $industryList = '<option value="">--- Select ---</option>';
        foreach ($empIndustries as $industry) {
            $selected = ($selectedIndustry == $industry->id) ? 'selected' : '';
            $industryList .= '<option value="'.$industry->id.'" '.$selected.'>'.$industry->name.'</option>';
        }

        //Build Main Category Dropdown
        $categoryList = '<option value="">--- Select ---</option>';
        foreach ($empMainCategory as $category) {
            $selected = ($selectedCategory == $category->id) ? 'selected' : '';
            $categoryList .= '<option value="'.$category->id.'" '.$selected.'>'.$category->name.'</option>';
        }

        $html = '
            <div class="row">

                <div class="col-12 col-md-6 mb-3"> 
                    <label>Company / Employer</label>
                    <input type="text"
                        name="company_name"
                        value="'.$company_name.'"
                        placeholder="Type Company / Employer"
                        class="form-control"/>
                    <small class="text-danger error-text company_name_error"></small>
                </div>

                <div class="col-12 col-md-6 mb-3"> 
                    <label>Role / Designation</label>
                    <select name="designation_id" class="form-control select2">
                        '.$designationList.'
                    </select>
                    <small class="text-danger error-text designation_id_error"></small>
                </div>

                <div class="col-12 col-md-6 mb-3"> 
                    <label>Employee Category</label>
                    <select name="category_id" class="form-control select2">
                        '.$categoryList.'
                    </select>
                    <small class="text-danger error-text category_id_error"></small>
                </div>

                <div class="col-12 col-md-6 mb-3"> 
                    <label>Industry (optional)</label>
                    <select name="industry_id" class="form-control select2">
                        '.$industryList.'
                    </select>
                </div>
                <div class="col-12 col-md-6 mb-3"> 
                    <label>Start Date</label>
                    <div class="input-group">
                        <input type="text"
                            name="add_start_date"
                            id="add_start_date"
                            class="form-control custom-input"
                            value="'.$start_date.'"
                            placeholder="Select Start Date"
                            autocomplete="off">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                    <small class="text-danger error-text add_start_date_error"></small>
                </div>
                <div class="col-12 col-md-6 mb-3"> 
                    <label>End Date</label>
                    <div class="input-group">
                        <input type="text"
                            name="add_end_date"
                            id="add_end_date"
                            class="form-control custom-input"
                            value="'.$end_date.'"
                            placeholder="Select End Date"
                            autocomplete="off">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                    <small class="text-danger error-text add_end_date_error"></small>
                </div>

                <div class="col-12 col-md-12 mb-3"> 
                    <label>About the role (optional)</label>
                    <textarea name="about_role" class="form-control" rows="5">'.$about_role.'</textarea>
                </div>
            </div>
        ';

        return response()->json([
            'status' => true,
            'data' => $html,
            'page_id' => $empId
        ]);
    }
    

    

}
