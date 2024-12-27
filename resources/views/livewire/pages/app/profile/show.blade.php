<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;
use App\Models\Profile;
use App\Models\Booking;
use App\Models\Course;

new #[Layout('layouts.app')] #[Title('My profile')] class extends Component {
    public User $user;
    public Profile $profile;

    public function mount()
    {
        $this->user = Auth::user();
        $this->profile = Profile::where("user_id", auth()->user()->id)->first();
    }

    public function getCourseName(Booking $booking)
    {
        return Course::where("id", $booking->course_id)->first()->name;
    }
}; ?>

<section>
    <x-container>
        <div class="flex gap-10 pt-10">
            <aside>
                <header>
                    <img src="{{$this->profile->avatar}}" alt="{{$this->profile->first_name . ' ' . $this->profile->last_name}}"/>
                    <div>
                        <h3></h3>
                        <p></p>
                    </div>
                </header>
            </aside>
            <main class="w-full">
                <section class="grid grid-cols-2 gap-10">
                    <x-form.form class="grid gap-4">
                        <x-subtitle>Change password</x-subtitle>
                        <x-form.label>Current password</x-form.label>
                        <x-form.input type="password" name="password" />
                        <x-form.label>New password</x-form.label>
                        <x-form.input type="password" name="new_password" />
                        <x-form.label>Confirm password</x-form.label>
                        <x-form.input type="password" name="new_password_confirmation" />
                        <x-button class="w-1/3">Save</x-button>
                    </x-form.form>
                    <x-form.form class="grid gap-4">
                        <x-subtitle>Update profile</x-subtitle>
                        <x-form.label>First name</x-form.label>
                        <x-form.input type="text" name="first_name" value="{{$this->profile->first_name}}"/>
                        <x-form.label>Last name</x-form.label>
                        <x-form.input type="text" name="last_name" value="{{$this->profile->last_name}}"/>
                        <x-form.label>Email</x-form.label>
                        <x-form.input type="email" name="email" value="{{$this->profile->email}}"/>
                        <x-button class="w-1/3">Save</x-button>
                    </x-form.form>
                </section>
                <section class="">
                    <x-subtitle>{{__("Booked courses")}}</x-subtitle>
                    <ul>
                        @foreach ($this->user->bookings as $booking)
                            <li class="mt-3">
                                <a href="{{ route('courses.show', ['course' => $booking->course_id]) }}">
                                    {{ $this->getCourseName($booking) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </main>
        </div>
    </x-container>
</section>
