<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Services\Stripe\StripeService;
use App\Models\User;
use App\Models\Profile;
use App\Models\Booking;
use App\Models\Course;

new #[Layout('layouts.app')] #[Title('My profile')] class extends Component {
    public User $user;
    public Profile $profile;
    private StripeService $stripeService;

    public function mount()
    {
        $this->stripeService = app(StripeService::class);

        $this->user = Auth::user()->load('bookings.course');
        $this->profile = Profile::where("user_id", auth()->user()->id)->first();
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
                <div x-data="{ activeTab: 'courses' }">
                    <div class="flex items-center border border-gray-300 rounded-xl bg-white mb-6">
                        <button @click="activeTab = 'courses'" :class="{ 'border-b-2 border-blue-500': activeTab === 'courses' }" class="px-4 py-2">Booked courses</button>
                        <button @click="activeTab = 'password'" :class="{ 'border-b-2 border-blue-500': activeTab === 'password' }" class="px-4 py-2">Password</button>
                        <button @click="activeTab = 'profile'" :class="{ 'border-b-2 border-blue-500': activeTab === 'profile' }" class="px-4 py-2">Profile</button>    
                        @if ($this->user->stripe_id)
                            <button @click="activeTab = 'credit-cards'" :class="{ 'border-b-2 border-blue-500': activeTab === 'credit-cards' }" class="px-4 py-2">Credit cards</button>
                        @endif
                    </div>
                    <section class="grid grid-cols-2 gap-10">
                        <x-form.form class="grid gap-4" x-show="activeTab === 'password'">
                            <x-subtitle>Change password</x-subtitle>
                            <x-form.label>Current password</x-form.label>
                            <x-form.input type="password" name="password" />
                            <x-form.label>New password</x-form.label>
                            <x-form.input type="password" name="new_password" />
                            <x-form.label>Confirm password</x-form.label>
                            <x-form.input type="password" name="new_password_confirmation" />
                            <x-button class="w-1/3">Save</x-button>
                        </x-form.form>
                        <x-form.form class="grid gap-4" x-show="activeTab === 'profile'">
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
                    <section class="" x-show="activeTab === 'courses'">
                        <x-subtitle>{{__("Booked courses")}}</x-subtitle>
                        <ul>
                            @forelse ($this->user->bookings as $booking)
                                <li class="mt-3">
                                    <a href="{{ route('courses.show', ['course' => $booking->course_id]) }}">
                                        {{ $booking->course->name }}
                                    </a>
                                </li>
                            @empty
                                <li class="mt-3">
                                    {{__("You haven't booked any courses yet")}}
                                </li>
                            @endforelse
                        </ul>
                    </section>
                    @if ($this->user->stripe_id)
                    <section class="" x-show="activeTab === 'credit-cards'">
                        <x-subtitle>{{__("Credit cards")}}</x-subtitle>
                        <livewire:profile.credit-cards :stripe-id="$this->user->stripe_id" />
                    </section>
                    @endif
                </div>
            </main>
        </div>
    </x-container>
</section>
