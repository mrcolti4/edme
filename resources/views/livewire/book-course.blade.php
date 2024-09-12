<?php

use App\Livewire\Forms\BookingForm;
use Livewire\Volt\Component;
use App\Models\Course;
use App\Models\Category;

new class extends Component {
    public BookingForm $form;
    public $courses = [];
    public $categories = [];
    public $classes;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function selectCategory(string $categoryId)
    {
        $this->courses = Course::where('category_id', $categoryId)->get('name', 'id');
    }
};
?>

<x-form.form wire:submit="form.submit" class="{{ $classes }} px-[50px] pt-[30px] pb-10 grid gap-6 text-primary">
    <x-form.label>
        {{ __('Categories') }}
        <x-form.select wire:model.live="form.category" wire:change="selectCategory($event.target.value)" :options="$categories"
            class="mt-2 bg-selectCategory" />
    </x-form.label>
    @if (count($courses) > 0)
        <x-form.label>
            {{ __('Courses') }}
            <x-form.select wire:model="courses" :options="$courses" class="mt-2 bg-selectClass" />
        </x-form.label>
        <x-form.label>
            {{ __('Count of seats to book') }}
            <x-form.input wire:model="form.seats" name="seats" placeholder="3" class="w-full bg-select" type="number"
                min="1" max="5" />
        </x-form.label>
        <x-button type="submit" class="mt-9 px-10 py-4 max-w-[50%]">
            {{ __('Book course') }}
        </x-button>
    @endif
</x-form.form>
