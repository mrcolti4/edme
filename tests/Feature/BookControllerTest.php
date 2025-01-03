<?php

use App\Models\User;
use App\Models\Course;
use App\Models\Booking;
use App\Services\Stripe\StripeService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Exceptions\PaymentFailed;
use Mockery;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->user = User::factory()->create();
    $this->course = Course::factory()->create([
        'students_limit' => 10,
        'price' => 1000
    ]);
    $this->stripeService = Mockery::mock(StripeService::class);
    app()->instance(StripeService::class, $this->stripeService);
});

it('books a course successfully', function () {
    $sessionMock = (object)[
        'id' => 'test_session_id',
        'url' => 'https://stripe.com/checkout/test'
    ];

    $this->stripeService
        ->shouldReceive('createCheckoutSession')
        ->once()
        ->with($this->course)
        ->andReturn($sessionMock);

    $response = $this->actingAs($this->user)
        ->post(route('book', $this->course));

    $response->assertRedirect($sessionMock->url);

    $this->assertDatabaseHas('bookings', [
        'user_id' => $this->user->id,
        'course_id' => $this->course->id,
        'session_id' => $sessionMock->id,
        'price' => $this->course->price,
        'status' => 'pending'
    ]);
});

it('prevents booking when course is full', function () {
    // Create bookings up to the limit
    Booking::factory()->count($this->course->students_limit)->create([
        'course_id' => $this->course->id
    ]);

    $response = $this->actingAs($this->user)
        ->post(route('book', $this->course));

    $response->assertRedirect();
    $response->assertSessionHas('error', 'Course is full');
});

it('prevents duplicate booking', function () {
    // Create an existing booking for the user
    Booking::factory()->create([
        'user_id' => $this->user->id,
        'course_id' => $this->course->id
    ]);

    $response = $this->actingAs($this->user)
        ->post(route('book', $this->course));

    $response->assertRedirect();
    $response->assertSessionHas('error', 'You have already booked this course');
});

it('handles successful checkout', function () {
    $sessionId = 'test_session_id';
    $receiptMock = ['receipt_data' => 'test'];

    $this->stripeService
        ->shouldReceive('validateCheckoutSession')
        ->once()
        ->with($sessionId)
        ->andReturn($receiptMock);

    $response = $this->actingAs($this->user)
        ->get(route('checkout.success', ['session_id' => $sessionId]));

    $response->assertRedirect(route('booking.success-page'));
    $response->assertSessionHas('receipt', json_encode($receiptMock));
});

it('handles failed checkout', function () {
    $sessionId = 'test_session_id';

    $this->stripeService
        ->shouldReceive('validateCheckoutSession')
        ->once()
        ->with($sessionId)
        ->andThrow(new PaymentFailed());

    $response = $this->actingAs($this->user)
        ->get(route('checkout.success', ['session_id' => $sessionId]));

    $response->assertRedirect(route('booking.cancel'));
});
