<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;
use App\Models\Course;

new #[Layout('layouts.app')] #[Title('Courses')] class extends Component {
    use WithPagination;

    public function with()
    {
        return [
            'courses' => Course::paginate(6),
        ];
    }
}; ?>


<section>
    <x-container>
        <x-courses.index :courses="$courses" />
        {{ $courses->links() }}
    </x-container>
</section>
