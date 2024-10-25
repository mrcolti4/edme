<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Modelable;
use App\Models\User;
use App\Models\Course;
use App\Models\Review;

new class extends Component {
    #[Modelable]
    public Course $course;
    public Review $review;
    public string $comment;
    public int $rating;
    public User $user;

    public function mount()
    {
        if ($this->review !== null) {
            $this->rating = $this->review->rating;
        }
    }

    public function submit()
    {
    }
}; ?>

<x-form.form action="{{ route('review.submit', ['course' => $course->id]) }}" method="POST" x-data="{ hover: 0 }" class="grid gap-5">
    <x-form.label class="grid">
        {{__("Your overall rating")}}
        <div>
            @for ($i = 1; $i <= 5; $i++)
                @php
                    $width = min(max(($rating - $i + 1) * 100, 0), 100);
                @endphp
                    <x-courses.star
                        width="{{$width}}"
                        size="lg"
                    >
                        <input class="w-full h-full absolute top-0 left-0 z-10 bg-transparent opacity-0" type="radio" name="rating" value="{{$i}}" wire:model.live="rating" />
                    </x-courses.star>
            @endfor
        </div>
    </x-form>
    <x-form.label class="grid">
        {{__("Your review")}}
        <x-form.textarea name="comment" placeholder="Tell people your review">
        {{$this->review->comment ?? ''}}
        </x-form.textarea>
    </x-form>
    <x-button class="w-[300px]">{{__("Submit your review")}}</x-button>
</x-form.form>
