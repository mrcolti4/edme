<?php

use Livewire\Volt\Component;
use Livewire\Volt\Macros\Modelable;
use Livewire\Volt\Macros\Reactive;

new class extends Component {
    #[Modelable]
    public string $model = '';
    #[Reactive]
    public $options = [];
}; ?>

<x-form.label>
    {{ __('Categories') }}
    <x-form.select wire:model.live="model" @change='dispatch("get-courses", {category: "{{ $model }}"})'
        :options="$options" class="mt-2 bg-selectCategory" />
</x-form.label>
