@props(['categories' => []])

<ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
    @foreach ($categories as $category)
        <x-category.category :category="$category" />
    @endforeach
</ul>
