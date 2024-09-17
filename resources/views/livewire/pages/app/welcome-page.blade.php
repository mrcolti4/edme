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
            <x-category.index :categories="$this->categories" />
        </x-container>
    </section>
    <!-- Recent courses -->
    <section class="px-[85px] py-[120px] bg-dark-gray text-center">
        <x-container>
            <x-section-title class="mb-14">Recent Courses</x-section-title>
            <x-courses.index :courses="$this->recent_courses" />
            <x-button tag='a' href="{{ route('courses.index') }}" is-outline="true" class="!px-10 mt-12">Browse
                all courses</x-button>
        </x-container>
    </section>
    <!-- Schedule a live class -->
    <section class="pb-[125px]">
        <div class="pt-[126px] pb-[196px] bg-secondary">
            <x-section-title class="mb-15 text-white">{{ __('Schedule a Class or Session') }}</x-section-title>
        </div>
        <div class="bg-formBg bg-no-repeat bg-[50%_100px]">
            <livewire:book-course
                classes="-mt-[126px] max-w-[577px] bg-white mx-auto rounded-xl border-b-secondary border-b-8" />
        </div>
    </section>
    <!-- World class experts -->
    <section class="bg-dark-gray py-[126px] px-[75px]">
        <x-container>
            <x-section-title class="mb-12">World Class Experts</x-section-title>
            <x-teacher.list :teachers="$this->teachers" />
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
    <x-footer.index />
</main>
