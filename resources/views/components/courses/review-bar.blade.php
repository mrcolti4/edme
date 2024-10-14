@props(['rating'])

@php
    $percent = $this->getReviewsPercentByNum($rating);
@endphp

<li class="flex items-center gap-2">
    <x-courses.stars :rating="$rating"/>
    <div class="review-bar relative w-3/4 h-1.5 bg-gray-300 rounded-2xl after:block after:content-[''] after:overflow-hidden after:absolute after:top-0 after:left-0 after:h-1.5 after:bg-secondary after:rounded-2xl"
    style="--width: {{$percent}}%"></div>
    <span>{{$percent}}%</span>
</li>
