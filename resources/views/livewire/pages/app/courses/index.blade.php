<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;
use App\Models\Course;

new #[Layout('layouts.app')] #[Title('Courses')] class extends Component {
    use WithPagination;
    public $userBookings = [];

    public function mount()
    {
        $bookings = auth()
            ->user()
            ->bookings()
            ->get(['course_id', 'status'])
            ->toArray();

        $this->userBookings = array_column($bookings, 'status', 'course_id');
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
        <x-courses.index :courses="$courses" :user-bookings="$userBookings" />
        {{ $courses->links() }}
    </x-container>
</section>
