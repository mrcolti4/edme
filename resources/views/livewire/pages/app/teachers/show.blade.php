<!-- TODO: implement page for one teacher -->
<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;

new #[Layout("layouts.app")] #[Title("Teachers")] class extends Component {
    public User $teacher;

    public function mount()
    {
    }
}; ?>

<section>
    <x-container>

    </x-container>
</section>
