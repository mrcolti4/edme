<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Course;
use App\Models\User;
use App\Models\Profile;
use App\Livewire\Forms\BookingForm;

new #[Layout("layouts.booking")] #[Title("You successfully paid for course")] class extends Component {
    public function showCourse()
    {
        $this->redirect(route("profile.show"));
    }
}; ?>

<div class="flex flex-col justify-center items-center h-screen">
    <svg
    class="h-24 w-24 text-green"
    xmlns="http://www.w3.org/2000/svg"
    width="24"
    height="24"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    strokeWidth="2"
    strokeLinecap="round"
    strokeLinejoin="round"
    >
    <circle cx="12" cy="12" r="10" />
    <path d="m9 12 2 2 4-4" />
    </svg>
    <h1 class="text-3xl font-bold mt-4">{{__("Payment Successful")}}</h1>
    <div class="mt-8 w-full max-w-md">
        <h2 class="text-center font-bold text-xl mb-5">{{__("Payment Details")}}</h2>
        <ul class="grid gap-4">
            <li class="flex items-center justify-between">
                <p class="text-sm font-medium">{{__("Amount:")}}</p>
                <p class="text-sm">$99.99</p>
            </li>
            <li class="flex items-center justify-between">
                <p class="text-sm font-medium">{{__("Date:")}}</p>
                <p class="text-sm">30.10.2024</p>
            </li>
            <li class="flex items-center justify-between">
                <p class="text-sm font-medium">{{__("Payment Method:")}}</p>
                <p class="text-sm">Visa **** 1234</p>
            </li>
        </ul>
    </div>
    <x-button wire:click="showCourse" class="mt-8">{{__("Go to course")}}</x-button>
</div>
