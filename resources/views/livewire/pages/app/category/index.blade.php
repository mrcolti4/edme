<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\Category;

new #[Layout('layouts.app')] #[Title('Hot & Popular Category For Learn')] class extends Component {
    public $categories = [];

    public function mount()
    {
        $this->categories = Category::all();
    }
}; ?>

<section>
    <x-container>
        <x-category.index :categories="$this->categories" />
    </x-container>
</section>
