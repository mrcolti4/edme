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

    public function deleteReview()
    {
        $this->form->destroy();

        $this->dispatch("review-event", message: "You did delete your review!");
    }
}; ?>

<div>
    @if ($isEditing)
        <div class="relative">
            <livewire:review-form :review="$this->review" />
            <button wire:click="closeForm" class="absolute top-0 right-0">Close</button>
        </div>
    @else
        <div class="border border-gray-400 p-2">
            <x-courses.reviews.show :review="$this->review"/>
            @can('update', $review)
                <div class="flex gap-3 items-center">
                    <!-- TODO: implement update and delete review markup -->
                    <button wire:click="showForm">{{__("Edit")}}</button>
                    <button @click="$dispatch('open-modal', 'confirm-review-deletion')">{{__("Delete")}}</button>
                </div>
            @endcan
        </div>
    @endif
</div>
