<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\VisitorsCount;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        //echo 'Admin';
        $admin = Auth::user();
        $visitor_counts = VisitorsCount::count() ?? 0;
        $user_counts = User::where('role','customer')->count() ?? 0;
        $order_counts = Order::where('status','!=','cancel')->count() ?? 0;
        $cancel_order_counts = Order::where('status','==','cancel')->count() ?? 0;

        //$admin = Auth::guard('admin')->user();
        // dd($admin);
       // Redirect to login if user is not an admin
        if (empty($admin) || $admin->role !== 'admin') {
            return redirect()->route('admin.login');
        }

        // Load the admin dashboard view
        return view('pages.dashboard.home.index', compact('visitor_counts','user_counts','order_counts','cancel_order_counts'));
    }
}
