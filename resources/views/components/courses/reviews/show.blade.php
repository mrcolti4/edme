@props(['review'])

<li class="flex justify-between">
    <div>
    {{$review->user->profile}}
    </div>
    <div></div>
    <x-courses.stars :rating="$review->rating"/>
</li>
