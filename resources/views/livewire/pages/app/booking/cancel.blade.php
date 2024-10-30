<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Course;
use App\Models\User;
use App\Models\Profile;
use App\Livewire\Forms\BookingForm;

new #[Layout("layouts.booking")] #[Title("Failed! Something went wrong!")] class extends Component {
    public function tryAgain()
    {
        $this->redirect(route("courses.index"));
    }

    public function backToHome()
    {
            $this->redirect(route("home"));
    }
}; ?>

<div>
    <div class="flex min-h-screen items-center justify-center bg-gray-100">
        <div class="mx-auto max-w-md rounded-lg bg-white p-8 shadow-lg">
            <div class="flex flex-col items-center text-center">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                strokeWidth="2"
                strokeLinecap="round"
                strokeLinejoin="round"
                aria-hidden="true"
                class="h-16 w-16 text-red-500"
            >
                <circle cx="12" cy="12" r="10" />
                <path d="m15 9-6 6" />
                <path d="m9 9 6 6" />
            </svg>
            <h1 class="mt-4 text-2xl font-bold text-gray-900">Payment Cancelled</h1>
            <p class="mt-2 text-gray-600">
                Your payment process has been cancelled. No charges have been made to your account.
            </p>
            <div class="mt-6 flex space-x-4">
                <button wire:click="tryAgain" class="bg-primary rounded-lg text-white px-4 py-2 font-bold transition hover:bg-primaryDark">
                    {{__("Try again")}}
                </button>
                <button wire:click="backToHome" class="border border-gray-300 rounded-xl px-4 py-2 transition hover:bg-gray-300">
                    {{__("Return to home page")}}
                </button>
            </div>
            </div>
        </div>
    </div>
</div>
