<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Course;
use Illuminate\Http\Request;

class BookingCourseController extends Controller
{
    protected $middleware = ['auth', 'verified'];
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Course $course)
    {
        // Check if course exists
        $request->validate([
            "student_id" => "required|exists:users,id",
            "course_id" => "required|exists:courses,id"
        ]);
        $request->user()->charge(100, $request->paymentMethodId);
        // Check if course is full
        if (Booking::where("course_id", $course->id)->count() === $course->students_limit) {
            return back()->with("error", "Course is full");
        }
        // Check if user has already booked this course
        if (Booking::where("student_id", $request->user()->id)->where("course_id", $course->id)->exists()) {
            return back()->with("error", "You have already booked this course");
        }
        // Book course
        Booking::create([
            "student_id" => $request->user()->id,
            "course_id" => $course->id
        ]);

        return back()->with("success", "You have successfully booked this course");
    }
}
