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
