<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Modelable;
use App\Models\Review;
use App\Models\Course;

new class extends Component {
    #[Modelable]
    public Course $course;
    public Review $review;
    public bool $isEditing = false;

    public function showForm()
    {
        $this->isEditing = true;
    }

    public function closeForm()
    {
        $this->isEditing = false;
    }
}; ?>

<div>
    @if ($isEditing)
        <div class="relative">
            <livewire:review-form wire:model="course" :review="$this->review"/>
            <button wire:click="closeForm" class="absolute top-0 right-0">Close</button>
        </div>
    @else
        <x-courses.reviews.show :review="$this->review"/>
        @can('update',$review)
            <div>
                <!-- TODO: implement update and delete review markup -->
                <button wire:click="showForm">Edit</button>
                <button>Delete</button>
            </div>
        @endcan
    @endif
</div>
