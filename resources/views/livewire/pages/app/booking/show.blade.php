<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Course;
use App\Models\User;
use App\Models\Profile;
use App\Livewire\Forms\BookingForm;

new #[Layout("layouts.blank")] #[Title("Book the course")] class extends Component {
    public Course $course;
    public ?User $user;
    public ?Profile $profile;
    public BookingForm $form;

    public function mount()
    {
        $this->user = auth()->user();
        if($this->user !== null) {
            $this->profile = Profile::where("user_id", $this->user->id)->first();
        }
    }

    public function book()
    {
        $this->redirect(route("booking.success"));
    }
}; ?>

<section class="pt-[200px]">
    <x-container>
        <div class="space-y-4">
            <x-section-title textLeft="true">{{$course->name}}</x-section-title>
            <x-subtitle>{{__("Buy this course for ") . " " . $course->price . "$"}}</x-subtitle>
        </div>
        <form wire:submit.prevent="book" class="mt-10 gap-4 grid grid-cols-3 grid-rows-2">
            <div class="col-start-1 col-end-3 row-start-1 row-end-2 space-y-4">
                <h3 class="text-gray-800 font-medium text-3xl">1. {{__("Contact information")}}</h3>
                <div class="flex gap-4">
                    <x-form.label>
                        {{__("First name")}}
                        <x-form.input wire:model="form.first_name" name="first_name" id="first_name"/>
                    </x-form>
                    <x-form.label>
                        {{__("Last name")}}
                        <x-form.input wire:model="form.last_name" name="last_name" id="last_name"/>
                    </x-form>
                </div>
                <div class="flex gap-4">
                    <x-form.label>
                        {{__("Phone number")}}
                        <x-form.input wire:model="form.phone" name="phone" id="phone"/>
                    </x-form>
                    <x-form.label>
                        {{__("Email")}}
                        <x-form.input wire:model="form.email" name="email" id="email"/>
                    </x-form>
                </div>
            </div>
            <div class="col-start-1 col-end-3 row-start-2 row-end-2 space-y-4">
                <h3 class="text-gray-800 font-medium text-3xl">2. {{__("Payment method")}}</h3>
                <div id="card-element"></div>
            </div>
            <div class="col-start-3 col-end-3 row-start-1 row-end-3">
                <div class="flex flex-col gap-3">
                    <div class="bg-secondary text-white px-6 py-3">
                        <div class="text-2xl font-bold">{{$course->name}}</div>
                    </div>
                    <hr class="my-4"/>
                    <div class="flex items-end justify-between">
                        <p class="text-primary font-bold text-2xl">{{__("Total: ")}}</p>
                        <p class="text-3xl text-primary">{{"$" . $course->price}}</p>
                    </div>
                    <button type="submit" class="bg-secondary text-white w-full py-6 font-bold text-2xl rounded-md mt-4 transition hover:cursor-pointer hover:bg-secondaryDark flex items-center justify-center gap-2">
                        {{__("Pay")}}<i class="fa-solid fa-arrow-right text-xl"></i>
                    </button>
                </div>
            </div>
        </form>
    </x-container>
</section>
