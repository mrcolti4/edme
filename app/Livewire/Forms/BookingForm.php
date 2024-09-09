<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class BookingForm extends Form
{
    #[Validate]
    public string $course = '';
    #[Validate]
    public string $date = '';

    public function messages()
    {
        return [
            'date.after' => 'Date is not in the course range',
            'date.before' => 'Date is not in the course range',
        ];
    }

    public function rules()
    {
        return [
            'course' => ['required', 'exists:App\Models\Course,id'],
            'date' => [
                'required',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    $course = \App\Models\Course::find($this->course);
                    if ($course && ($value < $course->start_date || $value > $course->end_date)) {
                        $fail('Date is out of range');
                    }
                },
            ],
        ];
    }
}
