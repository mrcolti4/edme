@props(['reviews'])

@foreach ($reviews as $item)
    <x-courses.reviews.show :review="$item"/>
@endforeach
