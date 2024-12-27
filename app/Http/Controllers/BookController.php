<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Course;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class BookController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function book(Request $request, Course $course)
    {
        // Check if course is full
        if (Booking::where("course_id", $course->id)->count() === $course->students_limit) {
            return back()->with("error", "Course is full");
        }
        // Check if user has already booked this course
        if (Booking::where("user_id", $request->user()->id)->where("course_id", $course->id)->exists()) {
            return back()->with("error", "You have already booked this course");
        }
        $session = Session::create([
            "line_items" => [
                [
                    "price_data" => [
                        "currency" => "usd",
                        "product_data" => [
                            "name" => $course->name,
                        ],
                        "unit_amount" => $course->price * 100,
                    ],
                    "quantity" => 1,
                ],
            ],
            "mode" => "payment",
            "success_url" => route("booking.success") . '?session_id={CHECKOUT_SESSION_ID}',
            "cancel_url" => route("booking.cancel"),
            "customer_email" => $request->user()->email,
            'metadata' => ['course_id' => $course->id, 'user_id' => auth()->id()],
        ]);
        
        // Book the course
        Booking::create([
            "user_id" => $request->user()->id,
            "course_id" => $course->id,
            "session_id" => $session->id,
            "status" => "pending",
        ]);
        return redirect($session->url);
    }

    public function checkoutSuccess(Request $request)
    {
        $sessionId = $request->query('session_id');

        $checkoutSession = Session::retrieve($sessionId);
        if ($checkoutSession->payment_status == 'paid') {
            $booking = Booking::where('session_id', $sessionId)->first();
            $booking->update(['status' => 'paid']);
            return redirect(env('APP_URL'));
        }
    }
}