<?php

use Livewire\Volt\Component;
use App\Models\User;

new class extends Component {
    public string $comment;
    public int $rating;
    public User $user;

    public function mount()
    {
    }
}; ?>

<x-form.form action="{{ route('review.submit') }}" method="POST" x-data="{ hover: 0 }" class="grid gap-5">
    <x-form.label class="grid">
        Your overall rating
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
        Your review
        <x-form.textarea placeholder="Tell people your review"/>
    </x-form>
    <x-button>Submit your review</x-button>
</x-form.form>
