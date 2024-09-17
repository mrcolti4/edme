@props(['teacher'])

<li class="text-center flex flex-col gap-6">
    <img src="{{ $teacher->profile->avatar }}" alt="{{ $teacher->name }}" class="w-[238px] mx-auto" />
    <div>
        <x-link href="#">{{ $teacher->name }}</x-link>
        <p class="text-text-gray font-opensans text-lg">Teacher</p>
    </div>
    <x-teacher.links :links="json_decode($teacher->contact->social_links)" />
</li>
