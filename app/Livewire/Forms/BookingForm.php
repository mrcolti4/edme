<?php

namespace App\Livewire\Forms;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BookingForm extends Form
{
    #[Validate('required|string|max:255|min:2')]
    public string $first_name = '';

    #[Validate('required|string|max:255|min:2')]
    public string $last_name = '';

    #[Validate('required|string')]
    public string $phone = '';

    #[Validate('required|email')]
    public string $email = '';

    #[Validate('required|exists:App\Models\Course,id')]
    public string $course = '';

    #[Validate('required|numeric|min:1|max:5')]
    public string $seats = '';

    public function book(array $data)
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        Booking::create($data);
    }
}
