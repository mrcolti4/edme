<main>
    <!-- Hero section with slider -->
    <section class="bg-heroBg pt-[180px] h-screen">
        <div class="swiper relative w-full h-full">
            <div class="swiper-wrapper w-full h-full">
                <livewire:home-slide />
                <livewire:home-slide />
                <livewire:home-slide />
                <livewire:home-slide />
            </div>
            <div class="absolute right-0 bottom-0 xl:h-[696px] z-10">
                <svg class="w-[200px] h-[240px] lg:w-[345px] lg:h-[465px] xl:w-auto xl:h-auto" preserveAspectRatio="none"
                    width="516" height="696" viewBox="0 0 516 696" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="background">
                    <path
                        d="M325.687 194.847C389.949 149.438 452.012 66.8755 516 0V696H11.7873C-65.6547 433.452 261.424 240.256 325.687 194.847Z"
                        fill="#418B78"></path>
                </svg>
                <div
                    class="absolute right-0 bottom-0 z-50 text-white text-2xl font-semibold h-full w-full flex items-center justify-center  px-40 pt-[150px] pb-10">
                    <div class="relative h-full flex items-center">
                        <div class="swiper-button-prev after:hidden absolute !-left-[50px]">
                            <i class="fa-solid fa-arrow-left text-white text-sm"></i>
                        </div>
                        <span class="text-[55px] font-extrabold">1</span>
                        <span>/</span>
                        <span>3</span>
                        <div class="swiper-button-next after:hidden absolute !left-[80px]">
                            <i class="fa-solid fa-arrow-right text-white text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Advantages section -->
    <section class="pt-[88px] pb-[115px] px-[90px] bg-dark-gray">
        <x-container>
            <ul class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <x-home.advantage />
                <x-home.advantage />
                <x-home.advantage />
            </ul>
        </x-container>
    </section>
    <!-- All categories -->
    <section class="px-[75px] py-[110px]">
        <x-container>
            <x-section-title class="mb-15">Popular Categories</x-section-title>
            <x-category.index />
        </x-container>
    </section>
    <!-- Recent courses -->
    <section class="px-[85px] py-[120px] bg-dark-gray text-center">
        <x-container>
            <x-section-title class="mb-14">Recent Courses</x-section-title>
            <livewire:recent-courses />
            <x-button tag='a' href="#" is-outline="true" class="!px-10 mt-12">Browse all courses</x-button>
        </x-container>
    </section>
    <!-- Schedule a live class -->
    <section class="pb-[125px]">
        <div class="pt-[126px] pb-[196px] bg-secondary">
            <x-section-title class="mb-15 text-white">{{ __('Schedule a Class or Session') }}</x-section-title>
        </div>
        <div class="bg-formBg bg-no-repeat bg-[50%_100px]">
            <livewire:booking-form
                class="-mt-[126px] max-w-[577px] bg-white mx-auto rounded-xl border-b-secondary border-b-8" />
        </div>
    </section>
    <!-- World class experts -->
    <section class="bg-dark-gray py-[126px] px-[75px]">
        <x-container>
            <x-section-title class="mb-12">World Class Experts</x-section-title>
            <livewire:teachers-list />
        </x-container>
    </section>
    <!-- Testimonials -->
    <section class="px-5 md:px-[90px] py-[150px] md:bg-testimonialBg bg-left-bottom bg-no-repeat">
        <div class="container mx-auto flex flex-col md:flex-row">
            <div class="w-full md:w-2/5 max-md:mb-4">
                <img src="{{ asset('images/feedback.png') }}" width="300" height="300" alt="Testimonial"
                    class="border-green rounded-full border-[47px]" />
            </div>
            <div class="w-full md:w-3/5 bg-testimonialSwiperBg bg-[0_0] lg:bg-[82%_91%] bg-no-repeat relative">
                <x-subtitle class="text-secondary mb-12 md:mb-8">What People Say</x-subtitle>
                <div class="testimonial-swiper swiper relative">
                    <div class="swiper-wrapper">
                        <livewire:testimonial-slide />
                        <livewire:testimonial-slide />
                        <livewire:testimonial-slide />
                    </div>
                </div>
                <div class="swiper-pagination !-bottom-12"></div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="relative overflow-hidden">
        <div class="container mx-auto flex">
            <div class="flex flex-wrap w-3/5 py-20 max-md:flex-col max-md:gap-8">
                <div class="md:w-1/3">
                    <x-subtitle>{{ __('About') }}</x-subtitle>
                    <x-footer.links>
                        <x-footer.link href="#">{{ __('About') }}</x-footer.link>
                        <x-footer.link href="#">{{ __('Contact') }}</x-footer.link>
                        <x-footer.link href="#">{{ __('Team') }}</x-footer.link>
                    </x-footer.links>
                </div>
                <div class="md:w-1/3">
                    <x-subtitle>{{ __('Popular Category') }}</x-subtitle>
                    <x-footer.links>
                        <x-footer.link href="#">{{ __('About') }}</x-footer.link>
                        <x-footer.link href="#">{{ __('Contact') }}</x-footer.link>
                        <x-footer.link href="#">{{ __('Team') }}</x-footer.link>
                    </x-footer.links>
                </div>
                <div class="md:w-1/3">
                    <x-subtitle>{{ __('Social') }}</x-subtitle>
                    <x-footer.links>
                        <x-footer.link href="#">{{ __('About') }}</x-footer.link>
                        <x-footer.link href="#">{{ __('Contact') }}</x-footer.link>
                        <x-footer.link href="#">{{ __('Team') }}</x-footer.link>
                    </x-footer.links>
                </div>
                <p class="w-full leading-[30px] text-text-gray font-opensans mt-20">
                    Edme © 2024 All Rights Reserved
                </p>
            </div>
            <div
                class="max-md:hidden md:w-2/5 relative flex items-center justify-center before:absolute before:top-0 before:-right-28 before:w-full before:h-full before:bg-secondary -z-20">
                <div class="text-white grid gap-7 items-center justify-center relative">
                    <h3 class="text-[34px] leading-[42px] text-white font-bold">{{ __('Get Started') }}</h3>
                    <p>{{ __('Book your first session') }}</p>
                    <x-button tag="a" href="#"
                        class="py-5 !px-10 rounded-[32px] leading-[19px] text-[15px] hover:bg-primary hover:border-primary"
                        is-outline="true">{{ __('Book today') }}</x-button>
                </div>
                <svg width="789" preserveAspectRatio="none" height="465" viewBox="0 0 789 465"
                    xmlns="http://www.w3.org/2000/svg" class="fill-secondary absolute right-0 top-0 -z-10 w-full">
                    <path class="back"
                        d="M194.578 178.421C227.705 152.454 259.699 105.242 292.685 67V465H32.7613C-7.16033 314.865 161.45 204.388 194.578 178.421Z">
                    </path>
                    <path class="front"
                        d="M181.185 1.71661e-05H789V465H71.6845C71.6845 465 155.685 313.5 62.6848 221C-30.3152 128.5 7.68492 0 7.68492 0L181.185 1.71661e-05Z">
                    </path>
                </svg>
            </div>
        </div>
    </footer>
</main>
