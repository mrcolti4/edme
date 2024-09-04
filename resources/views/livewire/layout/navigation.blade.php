<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: window.innerWidth > 768 ? true : false, openForm: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto py-4 px-6 sm:px-6 lg:px-8">
        <div class="max-sm:flex justify-between">
            <div class="flex justify-between">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a class="flex items-center gap-2" href="{{ route('home') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        <span class="text-primary uppercase font-bold text-3xl">Edme</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div x-show="open" x-cloak
                    class="absolute sm:relative bg-white w-full max-sm:top-20 left-0 bottom-0 right-0 m-0"
                    x-transition:enter="transition transform ease-out duration-300"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition transform ease-in duration-300"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                    <div class="pb-1 px-5 flex max-sm:flex-col sm:flex sm:items-center ju gap-7"
                        x-data="{ openSearch: window.innerWidth > 768 ? false : true }">
                        <div class="mt-3 sm:flex items-center gap-5 max-sm:space-y-5 sm:ml-auto">
                            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate>
                                {{ __('Home') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('home')" wire:navigate>
                                {{ __('Categories') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('home')" wire:navigate>
                                {{ __('Courses') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('home')" wire:navigate>
                                {{ __('Pages') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('home')" wire:navigate>
                                {{ __('Contact') }}
                            </x-responsive-nav-link>
                        </div>
                        <div class="sm:flex relative items-center ">
                            <button class="max-sm:hidden" @click="openSearch = !openSearch">
                                <svg fill="currentColor" width="22" height="22" viewBox="0 0 22 22"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21.7311 20.4672L17.95 16.7704L17.8614 16.6356C17.6966 16.4716 17.4713 16.3792 17.2361 16.3792C17.0009 16.3792 16.7756 16.4716 16.6108 16.6356C13.3974 19.5837 8.44596 19.7439 5.04021 17.0101C1.63445 14.2763 0.831235 9.4967 3.16325 5.84119C5.49527 2.18567 10.2389 0.788532 14.2481 2.57635C18.2574 4.36417 20.2882 8.78217 18.9937 12.9004C18.9005 13.1979 18.9767 13.5214 19.1936 13.7491C19.4105 13.9768 19.7352 14.074 20.0454 14.0042C20.3555 13.9344 20.604 13.7081 20.6972 13.4106C22.2446 8.52351 19.9075 3.26431 15.1977 1.03516C10.4879 -1.19398 4.81892 0.275906 1.85796 4.49396C-1.103 8.71201 -0.467303 14.4124 3.35382 17.9075C7.17495 21.4025 13.0348 21.6435 17.1425 18.4744L20.4904 21.7476C20.8362 22.0841 21.3952 22.0841 21.7409 21.7476C22.0864 21.4062 22.0864 20.8567 21.7409 20.5153L21.7311 20.4672Z">
                                    </path>
                                </svg>
                            </button>
                            <div class="sm:absolute top-1/2 sm:-translate-y-1/2 right-0 w-full">
                                <form
                                    class="sm:absolute top-1/2 sm:-translate-y-1/2 -right-4 max-w-[750px] sm:w-[100vw]"
                                    x-show="openSearch" x-transition:enter="transition opacity ease-out duration-300"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition opacity ease-in duration-300"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                    <label class="relative">
                                        <x-text-input name="search" placeholder="Search..."
                                            class="rounded-xl pl-7 py-4 w-full" />
                                        <button type="button" @click="openSearch = false"
                                            class="max-sm:hidden absolute right-0 top-1/2 -translate-y-1/2 w-16 h-16 hover:text-secondary transition-all flex items-center justify-center">
                                            <i class="fa-solid fa-xmark text-[22px]"></i>
                                        </button>
                                        <button type="submit"
                                            class="absolute right-2 sm:right-12 top-1/2 -translate-y-1/2 w-16 h-16 flex items-center justify-center hover:text-secondary transition-all">
                                            <svg fill="currentColor" width="22" height="22" viewBox="0 0 22 22"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21.7311 20.4672L17.95 16.7704L17.8614 16.6356C17.6966 16.4716 17.4713 16.3792 17.2361 16.3792C17.0009 16.3792 16.7756 16.4716 16.6108 16.6356C13.3974 19.5837 8.44596 19.7439 5.04021 17.0101C1.63445 14.2763 0.831235 9.4967 3.16325 5.84119C5.49527 2.18567 10.2389 0.788532 14.2481 2.57635C18.2574 4.36417 20.2882 8.78217 18.9937 12.9004C18.9005 13.1979 18.9767 13.5214 19.1936 13.7491C19.4105 13.9768 19.7352 14.074 20.0454 14.0042C20.3555 13.9344 20.604 13.7081 20.6972 13.4106C22.2446 8.52351 19.9075 3.26431 15.1977 1.03516C10.4879 -1.19398 4.81892 0.275906 1.85796 4.49396C-1.103 8.71201 -0.467303 14.4124 3.35382 17.9075C7.17495 21.4025 13.0348 21.6435 17.1425 18.4744L20.4904 21.7476C20.8362 22.0841 21.3952 22.0841 21.7409 21.7476C22.0864 21.4062 22.0864 20.8567 21.7409 20.5153L21.7311 20.4672Z">
                                                </path>
                                            </svg>
                                        </button>
                                    </label>
                                </form>
                            </div>
                        </div>
                        <x-button @click="openForm = !openForm" :is-outline="true" class="bg-transparent text-black">Book
                            today</x-button>
                        <div x-cloak x-show="openForm"
                            class="absolute bg-white w-full h-full max-sm:-top-20 left-0 bottom-0 right-0 m-0"
                            x-transition:enter="transition transform ease-out duration-300"
                            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                            x-transition:leave="transition transform ease-in duration-300"
                            x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                            <div class="bg-secondary p-9 relative">
                                <h2 class="font-bold text-3xl pr-5 text-white">Make an Appointment</h2>
                                <button @click="openForm = false"
                                    class="absolute top-4 right-4 z-10 text-white hover:text-black transition-all">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <x-form.form action="/" method="POST" class="px-9 mt-9">
                                <x-button>
                                    Next
                                </x-button>
                            </x-form.form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <x-button @click="open = ! open"
                    class="font-bold uppercase bg-primary text-white inline-flex items-center justify-center rounded-3xl px-6 py-3 hover:bg-secondary focus:outline-none focus:bg-secondary transition duration-150 ease-in-out">
                    Menu
                </x-button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
</nav>
