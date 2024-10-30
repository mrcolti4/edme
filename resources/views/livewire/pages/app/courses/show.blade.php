<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Livewire\Forms\ReviewForm;
use App\Models\Course;
use App\Models\Review;

new #[Layout('layouts.app')] #[Title('Course')] class extends Component {
    public Course $course;
    public ReviewForm $form;
    public $reviews = [];
    public ?Review $authUserReview;

    protected $listeners = [
        "review-event" => "redirectWithSuccess",
    ];


    public function mount()
    {
        $this->form = new ReviewForm($this, "");
        $this->authUserReview = $this->getAuthUserReview();
        if ($this->authUserReview !== null) {
            $this->form->setReview($this->authUserReview);
        }
        $this->reviews = Review::with("user.profile")
            ->latest()
            ->where("course_id", $this->course->id)
            ->get();
    }

    public function getReviews()
    {
        return $this->course->reviews;
    }

    public function getTeacher()
    {
        return $this->course->teacher;
    }

    public function getTeacherProfile()
    {
        return $this->course->teacher->profile;
    }

    public function getTeacherContacts()
    {
        return $this->course->teacher->contact;
    }
    private function getAvgRating(): float
    {
        $sum = 0;
        foreach ($this->reviews as $review) {
            $sum += $review->rating;
        }
        $result = $sum / count($this->reviews);

        return $sum === 0 ? 0 : round($result, 1);
    }

    private function getReviewsPercentByNum(float $num): float
    {
        $allReviews = count($this->reviews);
        $reviewsByNum = $this->reviews->filter(function ($review) use ($num) {
            return $review->rating === $num;
        });
        $result = count($reviewsByNum->all()) / $allReviews * 100;

        return $reviewsByNum->all() === 0 ? 0 : round($result, 1);
    }

    private function avgRating(): float
    {
        return $this->getAvgRating();
    }

    public function getAuthUserReview(): ?Review
    {
        if (!auth()->check()) {
            return null;
        }
        return $this->course
            ->reviews
            ->where("user_id", Auth::user()->id)
            ->first();
    }

    public function deleteReview()
    {
        $this->form->destroy();

        // FIX: event dispatch not working, here is directly function call
        $this->redirectWithSuccess("You did delete your review!");
    }

    public function redirectWithSuccess(string $message)
    {
        session()->flash("status", $message);

        $this->redirectRoute("courses.show", ["course" => $this->course]);
    }
}; ?>

@inject('carbon', 'Carbon\Carbon')
<section class="pt-[200px] bg-dark-gray">
    <x-container>
        <div class="flex gap-8">
            <div x-data="{ activeTab: 'reviews' }" class="w-4/6 px-4">
                <ul class="flex items-center border border-gray-300 rounded-xl bg-white mb-6">
                    <x-courses.tab-button x-on:click="activeTab = 'overview'">{{ __('Overview') }}</x-courses.tab-button>
                    <x-courses.tab-button
                        x-on:click="activeTab = 'instructor'">{{ __('Instructor') }}</x-courses.tab-button>
                    <x-courses.tab-button x-on:click="activeTab = 'reviews'">{{ __('Reviews') }}</x-courses.tab-button>
                </ul>
                <!-- Course description -->
                <div x-show="activeTab === 'overview'">
                    <h2 class="text-[34px] text-primary font-bold">{{ __('A short description') }}</h2>
                    <x-courses.description>{{ $this->course->description }}</x-courses.description>
                </div>
                <!-- Course instructor -->
                <div x-show="activeTab === 'instructor'">
                    <div class="flex gap-4">
                        <div class="w-1/3">
                            <img src="{{ $this->getTeacherProfile()->avatar }}" alt="{{ $this->getTeacher()->name }}" />
                        </div>
                        <div class="w-2/3">
                            <h3 class="text-2xl leading-6 font-semibold text-primary mb-2">
                                {{ $this->getTeacher()->name }}
                            </h3>
                            <p class="text-text font-lg leading-[18px] mb-4">Teacher</p>
                            <x-courses.description>{{ $this->getTeacherProfile()->about }}</x-courses.description>
                            <x-courses.description class="mt-4">
                                <a href="tel:{{ $this->getTeacherContacts()->phone }}"
                                    class="transition hover:text-secondary text-text block mb-2">{{ $this->getTeacherContacts()->phone }}</a>
                                <x-teacher.links :links="json_decode($this->getTeacherContacts()->social_links)" />
                            </x-courses.description>
                        </div>
                    </div>
                </div>
                <!-- Course reviews -->
                <div x-show="activeTab === 'reviews'">
                    <div class="flex gap-6 items-center">
                        <div class="w-1/4 bg-white border-gray-200 border rounded-xl py-6 px-8 text-center">
                            <x-section-title green="true">{{$this->getAvgRating()}}</x-section-title>
                            <p class="text-lg font-medium mt-3">
                                ({{ $this->course->reviews->count() }}
                                {{ Str::of('review')->plural($this->course->reviews->count()) }})
                            </p>
                            <x-courses.stars :rating="$this->getAvgRating()"/>
                        </div>
                        <div class="w-full">
                            <ul class="grid gap-2">
                                <x-courses.review-bar rating="5"/>
                                <x-courses.review-bar rating="4"/>
                                <x-courses.review-bar rating="3"/>
                                <x-courses.review-bar rating="2"/>
                                <x-courses.review-bar rating="1"/>
                            </ul>
                        </div>
                    </div>
                    @cannot('reviewCourse', $course)
                        @auth
                            @if ($authUserReview)
                                <x-subtitle class="my-6">{{__("You already left review on this course")}}</x-subtitle>
                                <livewire:update-review :review="$this->getAuthUserReview()" />
                            @endif
                        @endauth
                    @endcannot
                    <ul class="my-8">
                        <li>
                            <x-subtitle>{{(__("Latest reviews for this course"))}}</x-subtitle>
                        </li>
                        <x-courses.reviews.index :reviews="$this->reviews" />
                    </ul>
                    @can('reviewCourse', $course)
                        <livewire:review-form :course="$course"/>
                    @endcan
                </div>
            </div>
            <div class="w-2/6 bg-white p-8 relative">
                <div
                    class="absolute top-0 left-1/2 -translate-x-1/2 px-6 py-3 bg-secondary rounded-b-2xl text-white text-2xl leading-6 font-semibold text-center">
                    {{ $this->course->price }}$</div>
                <ul class="grid gap-4 mt-8">
                    <x-courses.card-item>
                        <x-courses.card-title>{{ __('Course dates') }}</x-courses.card-title>
                        <x-courses.card-text>{{ $this->course->getCourseDates() }}</x-courses.card-text>
                    </x-courses.card-item>
                    <x-courses.card-item>
                        <x-courses.card-title>{{ __('Seats left') }}</x-courses.card-title>
                        <x-courses.card-text>{{ $this->course->studentsLeft() }}</x-courses.card-text>
                    </x-courses.card-item>
                    <x-courses.card-item class="border-b border-b-light-gray pb-4">
                        <x-courses.card-title>{{ __('Course duration') }}</x-courses.card-title>
                        <x-courses.card-text>{{ $this->course->courseDuration() }}</x-courses.card-text>
                    </x-courses.card-item>
                    <li class="flex items-center gap-3 mt-3">
                        <a href="{{ route('teachers.show', ['teacher'=> $this->getTeacher()->id]) }}">
                            <img
                                src="{{ $this->getTeacherProfile()->avatar }}"
                                alt="{{ $this->getTeacher()->name }}"
                                width="47"
                                height="47"
                                class="rounded-full w-[47px] h-[47px]"
                            />
                        </a>
                        <div class="grid gap-2">
                            <a href="{{ route('teachers.show', ['teacher'=> $this->getTeacher()->id]) }}" class="font-semibold text-primary text-lg leading-5 transition hover:text-secondary">{{ $this->getTeacher()->name }}</a>
                            <p class="text-text font-opensans">{{__('Teacher')}}</p>
                        </div>
                    </li>
                    <li class="mt-3">
                        <x-button tag="a" isOutline="true" href="{{ route('booking.show', ['course' => $course]) }}">{{ __('Buy course') }}</x-button>
                    </li>
                </ul>
            </div>
        </div>
    </x-container>
    <!-- Flash messages -->
    @if(session("status"))
        <x-action-message status="success">
            {{session("status")}}
        </x-action-message>
    @endif
    <!-- Modal -->
    <x-modal name="confirm-review-deletion">
        <x-subtitle>{{__("Are you sure you want to delete your review?")}}</x-subtitle>
        <div class="flex gap-4 mt-4">
            <button x-on:click="show = false">{{__("Cancel")}}</button>
            <form wire:submit.prevent="deleteReview" class="py-4 px-8">
                    <x-danger-button type="submit">{{__("Yes")}}</x-danger-button>
            </form>
        </div>
    </x-modal>
</section>
