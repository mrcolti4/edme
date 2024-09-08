<?php

namespace App\Livewire;

use Livewire\Component;

class BookingForm extends Component
{
    public $class;

    public function mount($class = '')
    {
        $this->class = $class;
    }

    public function render()
    {
        return view('livewire.booking-form');
    }
}
