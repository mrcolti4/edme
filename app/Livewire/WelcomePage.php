<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Livewire\Component;

class WelcomePage extends Component
{
    public $categories = [];
    public $recent_courses = [];
    public $teachers = [];

    public function mount()
    {
        $this->categories = Category::where("on_homepage", 1)
            ->with("courses")
            ->get();

        $this->recent_courses = Course::latest()
            ->without("category")
            ->with([
                "teacher" => function ($query) {
                    $query->select("id", "name")->with("profile");
                },
            ])
            ->take(6)
            ->get();

        $this->teachers = (new User())->teachers()->take(3)->get();
    }

    public function render()
    {
        return view('livewire.pages.app.welcome-page');
    }
}
