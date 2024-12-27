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

<header class="absolute w-full py-11 t-0 l-0">
    <nav x-data="{ open: window.innerWidth > 640 ? true : false, openForm: false }">
        <!-- Primary Navigation Menu -->
        <div class="max-w-[1600px] mx-auto py-4 px-6 sm:px-6 lg:px-8">
            <div class="justify-between max-sm:flex">
                <div class="flex justify-between">
                    <!-- Logo -->
                    <div class="flex items-center shrink-0">
                        <a class="flex items-center gap-2" href="{{ route('home') }}" wire:navigate>
                            <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div x-show="open" x-cloak
                        class="absolute bottom-0 left-0 right-0 z-10 w-full m-0 sm:relative max-sm:h-screen max-sm:top-28"
                        x-transition:enter="transition transform ease-out duration-300"
                        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition transform ease-in duration-300"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                        <div class="flex px-5 pb-1 max-sm:flex-col sm:flex sm:items-center max-sm:bg-white max-sm:h-full gap-7"
                            x-data="{ openSearch: window.innerWidth > 640 ? false : true }">
                            <div class="items-center gap-5 mt-3 sm:flex max-sm:space-y-5 sm:ml-auto">
                                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate>
                                    {{ __('Home') }}
                                </x-responsive-nav-link>
                                <x-responsive-nav-link :href="route('categories.index')" wire:navigate>
                                    {{ __('Categories') }}
                                </x-responsive-nav-link>
                                <x-responsive-nav-link :href="route('courses.index')" wire:navigate>
                                    {{ __('Courses') }}
                                </x-responsive-nav-link>
                                <x-responsive-nav-link :href="route('home')" wire:navigate>
                                    {{ __('Contact') }}
                                </x-responsive-nav-link>
                                <x-responsive-nav-link :href="route('profile.show')" wire:navigate>
                                    {{ __('My Profile') }}
                                </x-responsive-nav-link>
                            </div>
                            <div class="relative items-center sm:flex ">
                                <button class="max-sm:hidden" @click="openSearch = !openSearch">
                                    <svg fill="currentColor" width="22" height="22" viewBox="0 0 22 22"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21.7311 20.4672L17.95 16.7704L17.8614 16.6356C17.6966 16.4716 17.4713 16.3792 17.2361 16.3792C17.0009 16.3792 16.7756 16.4716 16.6108 16.6356C13.3974 19.5837 8.44596 19.7439 5.04021 17.0101C1.63445 14.2763 0.831235 9.4967 3.16325 5.84119C5.49527 2.18567 10.2389 0.788532 14.2481 2.57635C18.2574 4.36417 20.2882 8.78217 18.9937 12.9004C18.9005 13.1979 18.9767 13.5214 19.1936 13.7491C19.4105 13.9768 19.7352 14.074 20.0454 14.0042C20.3555 13.9344 20.604 13.7081 20.6972 13.4106C22.2446 8.52351 19.9075 3.26431 15.1977 1.03516C10.4879 -1.19398 4.81892 0.275906 1.85796 4.49396C-1.103 8.71201 -0.467303 14.4124 3.35382 17.9075C7.17495 21.4025 13.0348 21.6435 17.1425 18.4744L20.4904 21.7476C20.8362 22.0841 21.3952 22.0841 21.7409 21.7476C22.0864 21.4062 22.0864 20.8567 21.7409 20.5153L21.7311 20.4672Z">
                                        </path>
                                    </svg>
                                </button>
                                <div class="right-0 w-full sm:absolute top-1/2 sm:-translate-y-1/2">
                                    <form
                                        class="sm:absolute top-1/2 sm:-translate-y-1/2 -right-4 max-w-[750px] sm:w-[100vw]"
                                        x-show="openSearch"
                                        x-transition:enter="transition opacity ease-out duration-300"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition opacity ease-in duration-300"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                        <label class="relative">
                                            <x-form.input name="search" placeholder="Search..."
                                                class="w-full py-4 rounded-xl pl-7" />
                                            <button type="button" @click="openSearch = false"
                                                class="absolute right-0 flex items-center justify-center w-16 h-16 transition-all -translate-y-1/2 max-sm:hidden top-1/2 hover:text-secondary">
                                                <i class="fa-solid fa-xmark text-[22px]"></i>
                                            </button>
                                            <button type="submit"
                                                class="absolute flex items-center justify-center w-16 h-16 transition-all -translate-y-1/2 right-2 sm:right-12 top-1/2 hover:text-secondary">
                                                <svg fill="currentColor" width="22" height="22"
                                                    viewBox="0 0 22 22" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M21.7311 20.4672L17.95 16.7704L17.8614 16.6356C17.6966 16.4716 17.4713 16.3792 17.2361 16.3792C17.0009 16.3792 16.7756 16.4716 16.6108 16.6356C13.3974 19.5837 8.44596 19.7439 5.04021 17.0101C1.63445 14.2763 0.831235 9.4967 3.16325 5.84119C5.49527 2.18567 10.2389 0.788532 14.2481 2.57635C18.2574 4.36417 20.2882 8.78217 18.9937 12.9004C18.9005 13.1979 18.9767 13.5214 19.1936 13.7491C19.4105 13.9768 19.7352 14.074 20.0454 14.0042C20.3555 13.9344 20.604 13.7081 20.6972 13.4106C22.2446 8.52351 19.9075 3.26431 15.1977 1.03516C10.4879 -1.19398 4.81892 0.275906 1.85796 4.49396C-1.103 8.71201 -0.467303 14.4124 3.35382 17.9075C7.17495 21.4025 13.0348 21.6435 17.1425 18.4744L20.4904 21.7476C20.8362 22.0841 21.3952 22.0841 21.7409 21.7476C22.0864 21.4062 22.0864 20.8567 21.7409 20.5153L21.7311 20.4672Z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </label>
                                    </form>
                                </div>
                            </div>
                            @guest
                                <x-button isOutline="true" tag="a" href="{{ route('login') }}" class="text-black bg-transparent">
                                    {{ __('Book today') }}
                                </x-button>
                            @endguest
                            @auth
                                <form wire:submit="logout">
                                    <x-button type="submit" >
                                        {{ __('Logout') }}
                                    </x-button>
                                </form>
                            @endauth
                            <div x-cloak x-show="openForm"
                                class="fixed top-0 bottom-0 left-0 right-0 z-20 w-full h-full m-0 bg-black/70 max-sm:top-20">
                                <div class="bg-white sm:w-[470px] w-full h-full ml-auto" x-show="openForm"
                                    @click.outside="openForm = false"
                                    x-transition:enter="transition transform ease-out duration-300"
                                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                                    x-transition:leave="transition transform ease-in duration-300"
                                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                                    <div class="relative bg-secondary p-9">
                                        <h2 class="pr-5 text-3xl font-bold text-white">{{ __('Make an Appointment') }}
                                        </h2>
                                        <button @click="openForm = false"
                                            class="absolute z-10 text-white transition-all top-4 right-4 hover:text-black">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                    <livewire:book-course />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="flex items-center -me-2 sm:hidden">
                    <x-button @click="open = ! open; lock = !lock"
                        class="inline-flex items-center justify-center px-6 py-3 font-bold text-white uppercase transition duration-150 ease-in-out bg-primary rounded-3xl hover:bg-secondary focus:outline-none focus:bg-secondary">
                        {{ __('Menu') }}
                    </x-button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
    </nav>
</header>
