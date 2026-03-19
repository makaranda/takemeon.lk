<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\TrainingBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

class TrainingBookingController extends Controller
{
public function index()
    {
        return view('pages.frontend.needtraining.index');
    }

    public function getBookings()
    {
        $bookings = TrainingBooking::with('user')->get();

        $events = [];

        foreach ($bookings as $booking) {
            $events[] = [
                'id' => $booking->id,
                'title' => $booking->user->name,
                'start' => $booking->training_date . 'T' . $booking->start_time,
                'end' => $booking->training_date . 'T' . $booking->end_time,
                'color' => match($booking->status) {
                    'approved' => 'green',
                    'pending' => 'orange',
                    'rejected' => 'red',
                }
            ];
        }

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'training_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $user = Auth::user();

        // Only active candidates
        if ($user->role !== 'candidate' || $user->status != 1 || $user->active != 1) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Prevent duplicate / overlapping booking
        $exists = TrainingBooking::where('training_date', $request->training_date)
            ->where(function ($q) use ($request) {
                $q->whereBetween('start_time', [$request->start_time, $request->end_time])
                  ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Time slot already booked']);
        }

        TrainingBooking::create([
            'user_id' => $user->id,
            'training_date' => $request->training_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        return TrainingBooking::with('user')->findOrFail($id);
    }

    public function approve($id)
    {
        $booking = TrainingBooking::with('user')->findOrFail($id);
        $booking->status = 'approved';
        $booking->save();

        // SMS
        SmsHelper::send(
            $booking->user->phone,
            "Hi {$booking->user->name},\nYour training on {$booking->training_date} ({$booking->start_time}-{$booking->end_time}) has been APPROVED."
        );

        return back()->with('success', 'Approved');
    }
}
