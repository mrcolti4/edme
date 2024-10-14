<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Course;

new #[Layout('layouts.app')] #[Title('Course')] class extends Component {
    public Course $course;

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
}; ?>

@inject('carbon', 'Carbon\Carbon')
<section class="pt-[200px] bg-dark-gray">
    <x-container>
        <div class="flex gap-8 ">
            <div x-data="{ activeTab: 'overview' }" class="w-4/6">
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
                    <div>
                        <x-section-title green="true">{{ $this->course->avgRating() }}</x-section-title>
                        <p class="text-lg font-medium">
                            {{ $this->course->reviews->count() }}
                            {{ Str::of('review')->plural($this->course->reviews->count()) }}
                        </p>
                        <x-courses.stars :rating="3.3" />
                    </div>
                    {{ $this->course->reviews }}
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
                        <img src="{{ $this->getTeacherProfile()->avatar }}" alt="{{ $this->getTeacher()->name }}"
                            width="47" height="47" class="rounded-full w-[47px] h-[47px]" />
                        <div class="grid gap-2">
                            <p class="font-semibold text-primary text-lg leading-5">{{ $this->getTeacher()->name }}</p>
                            <p class="text-text font-opensans">Teacher</p>
                        </div>
                    </li>
                    <li class="mt-3">
                        <x-form.form action="{{ route('courses.book', $course) }}" method="post">
                            <x-button>{{ __('Buy course') }}</x-button>
                        </x-form.form>
                    </li>
                </ul>
            </div>
        </div>
    </x-container>
</section>
@section('scripts')
    <script>
        const stars = document.querySelectorAll('.stars span');
        const rating = "3.3"
        stars.forEach((star, index) => {
            const width = Math.min(Math.max((rating - index) * 100, 0), 100);
            star.style.setProperty('--width', `${width}%`);
        });
    </script>
@endsection
