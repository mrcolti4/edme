<x-form.form action="/" method="POST" class="{{ $class }} px-[50px] pt-[30px] pb-10 grid gap-6 text-primary">
    <x-input-label>
        Category
        <x-form.select options="" class="mt-2 bg-selectCategory" />
    </x-input-label>
    <x-input-label>
        Select class *
        <x-form.select options="" class="mt-2 bg-selectClass" />
    </x-input-label>
    <x-input-label>
        Location
        <x-form.select options="" class="mt-2 bg-selectLocation" />
    </x-input-label>
    <x-input-label>
        Teacher
        <x-form.select options="" class="mt-2 bg-selectTeacher" />
    </x-input-label>
    <x-button class="mt-9 px-10 py-4 max-w-[50%]">
        Next
    </x-button>
</x-form.form>