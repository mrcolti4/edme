<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\ReviewForm;
use App\Models\Review;
use App\Models\Course;

new class extends Component {
    public Review $review;
    public bool $isEditing = false;
    public ReviewForm $form;

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
            <livewire:review-form :review="$this->review"/>
            <button wire:click="closeForm" class="absolute top-0 right-0">Close</button>
        </div>
    @else
        <div class="border border-gray-400 p-2">
            <x-courses.reviews.show :review="$this->review"/>
            @can('update', $review)
                <div>
                    <!-- TODO: implement update and delete review markup -->
                    <button wire:click="showForm">Edit</button>
                    <button>Delete</button>
                </div>
            @endcan
        </div>
    @endif
</div>
