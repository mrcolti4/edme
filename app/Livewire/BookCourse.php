<?php

namespace App\Livewire;

use App\Livewire\Forms\BookingForm;
use App\Models\Course;
use Livewire\Component;

class BookCourse extends Component
{
    public BookingForm $form;
    public $class;
    public $courses = [];

    public function mount($class = '')
    {
        $this->class = $class;
        $this->courses = Course::all();
    }

    public function submit()
    {
        $this->form->validate();
    }

    public function render()
    {
        return view('livewire.book-course');
    }
}
