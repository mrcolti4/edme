<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BookingForm extends Form
{
    #[Validate('required|exists:App\Models\Category,id')]
    public string $category = '';
    #[Validate('required|exists:App\Models\Course,id')]
    public string $course = '';
    #[Validate('required|numeric|min:1|max:5')]
    public string $seats = '';

    public function submit()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $this->validate();
    }
}
