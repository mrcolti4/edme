<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\ReviewForm;
use App\Models\User;
use App\Models\Review;
use App\Models\Course;

new class extends Component {
    public ?Review $review = null;
    public Course $course;
    public User $user;
    public ReviewForm $form;
    public ?int $rating = null;

    public function mount(Review $review)
    {
        $this->form->setReview($review);
    }

    public function store()
    {
        $this->form->store();

        $this->dispatch("review-event", message: "You did create review for this course!");
    }

    public function update()
    {
        $this->form->update();

        $this->dispatch("review-event", message: "You successfully updated your review!");
    }
}; ?>

<form wire:submit="{{$this->review ? 'update' : 'store'}}">
    <x-form.label class="grid">
        {{__("Your overall rating")}}
        <div>
            @for ($i = 1; $i <= 5; $i++)
                @php
                    $width = min(max(($this->form->rating - $i + 1) * 100, 0), 100);
                @endphp
                    <x-courses.star
                        width="{{$width}}"
                        size="lg"
                    >
                        <input class="w-full h-full absolute top-0 left-0 z-10 bg-transparent opacity-0" type="radio" name="rating" value="{{$i}}" wire:model.live="form.rating" />
                    </x-courses.star>
            @endfor
        </div>
        @error('form.rating') <span class="text-red-500">{{ $message }}</span> @enderror
    </x-form.label>
    <x-form.label class="grid">
        {{__("Your review")}}
        <x-form.textarea wire:model="form.comment" name="comment" placeholder="Tell people your review">
            {{$this->review->comment ?? ''}}
        </x-form.textarea>
        @error('form.comment') <span class="text-red-500">{{ $message }}</span> @enderror
    </x-form.label>
    <x-form.input hidden name="course_id" wire:model="form.course_id" value="{{$course->id}}" />
    <x-button type="submit" wire:loading.attr="disabled" class="w-[300px]">{{__("Submit your review")}}</x-button>
</form>
