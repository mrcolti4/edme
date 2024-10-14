<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Course;
use App\Models\Category;

new #[Layout('layouts.app')] #[Title('Hot & Popular Category For Learn')] class extends Component {
    public Category $category;
    public $courses = [];

    public function mount()
    {
        $this->courses = Course::where("category_id", $this->category->id)->get();
    }
};
?>

<section>
    <div class="container mx-auto">
        <x-courses.index :courses="$this->courses"/>
    </div>
</section>
