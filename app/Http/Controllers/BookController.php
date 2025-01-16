<?php

namespace App\Http\Controllers;

use App\Exceptions\PaymentFailed;
use App\Models\Booking;
use App\Models\Course;
use App\Services\Stripe\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Enums\Booking\Status;

class BookController extends Controller
{
    public function __construct(
        private StripeService $stripeService,
    ) {}

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
        
        $session = match ($request->get('promotion_code')) {
            null => $this->stripeService->createCheckoutSession($course),
            default => $this->stripeService->createCheckoutSessionWithCoupon($course, $request->get('promotion_code')),
        };
        // Book the course
        Booking::create([
            "user_id" => $request->user()->id,
            "course_id" => $course->id,
            "session_id" => $session->id,
            "price" => $course->price,
            "status" => "pending",
        ]);
        return redirect($session->url);
    }

    public function checkoutSuccess(Request $request)
    {
        $sessionId = $request->query('session_id');

        try {
            $receipt = $this->stripeService->validateCheckoutSession($sessionId);
        } catch (PaymentFailed $e) {
            return redirect(route("booking.cancel"));
        }

        return redirect(route("booking.success-page"))->with("receipt", json_encode($receipt));
    }

    public function resume(Request $request, Booking $booking)
    {
        $session = $this->stripeService->getCheckoutSessionById($booking->session_id);
        if ($session->status === Status::EXPIRED->value) {
            $booking->update([
                'status' => Status::EXPIRED->value
            ]);

            return redirect()->back()->with("error", "Your booking has expired");
        }

        return redirect($session->url);
    }
}