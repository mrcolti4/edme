<x-filament-panels::page>
    <x-section-title>{{ __('Manage Coupons') }}</x-section-title>

    <x-filament-panels::form
        id="form"
        wire:key="{{ 'forms.' . $this->getFormStatePath() }}"
    >
        {{ $this->form }}
    </x-filament-panels::form>

    {{ $this->table }}
</x-filament-panels::page>
