<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;
use App\Models\Course;

new #[Layout('layouts.app')] #[Title('Courses')] class extends Component {
    use WithPagination;
    public $userBookedCourses = [];

    public function mount()
    {
        $this->userBookedCourses = auth()->user()->bookings->pluck('course_id');
    }

    public function with()
    {
        return [
            'courses' => Course::paginate(6),
        ];
    }
}; ?>


<section>
    <x-container>
        <x-courses.index :courses="$courses" :user-booked-courses="$userBookedCourses->toArray()" />
        {{ $courses->links() }}
    </x-container>
</section>
