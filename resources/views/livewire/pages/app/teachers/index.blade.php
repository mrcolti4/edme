<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;

new #[Layout("layouts.app")] #[Title("Teachers")] class extends Component {
    public $teachers = [];

    public function mount()
    {
        $this->teachers = User::where("role", "teacher")
        ->latest()
        ->take(9)
        ->get();
    }
}; ?>

<section>
    <x-container>
        <x-teacher.list :teachers="$this->teachers"/>
    </x-container>
</section>
