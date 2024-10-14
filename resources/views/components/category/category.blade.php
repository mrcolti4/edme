@props(['category' => []])
<li class="">
    <div class="p-10 bg-dark-gray rounded-lg border border-light-gray hover:shadow-2xl hover:bg-white transition-all">
        <a href="" class="block mb-2">
            <img src="{{ $category->image }}" alt="{{ $category->name }}" class="max-w-11 max-h-11" />
        </a>
        <x-link href="{{ route('categories.show', ['category'=> $category->id]) }}">{{ $category->name }}</x-link>
        <p class="font-opensans leading-7">{{ count($category->courses) . ' ' . __('Courses') }}</p>
    </div>
</li>
