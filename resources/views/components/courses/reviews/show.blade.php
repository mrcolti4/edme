@props(['review'])

<li class="flex justify-between border-b-gray-400 border-b py-6">
    <div class="flex max-md:flex-col gap-3 w-4/5 items-center">
        <img src="{{$review->user->profile->avatar}}" alt="{{$review->user->name}}" class="rounded-full w-24 h-24"/>
        <div class="text-primary space-y-2">
            <h3 class="text-lg font-bold">{{$review->user->name}}</h3>
            <p>{{\Carbon\Carbon::parse($review->created_at)->toFormattedDateString()}}</p>
            <p class="font-medium text-lg">{{$review->comment}}</p>
        </div>
    </div>
    <x-courses.stars :rating="$review->rating"/>
</li>
