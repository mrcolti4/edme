@props(['course' => [], 'isBooked' => false])

<li>
    <div class="relative bg-white rounded-2xl text-left">
        <div
            @class([
                'absolute top-0 left-0 bg-green text-white pt-2 pr-4 pb-2.5 pl-4.5 rounded-br-2xl rounded-tl-2xl text-2xl font-semibold leading-6',
                'bg-red-500' => $isBooked,
                'bg-green' => !$isBooked,
            ])
            >
            {{ $isBooked ? 'PAID' : '$' . $course->price }}
        </div>
        <a href="{{ route('courses.show', $course) }}">
            <img alt="{{ $course->name }}" src="{{ $course->image }}" class="rounded-2xl" />
        </a>
        <div class="p-5 grid gap-5">
            <x-link href="{{ route('courses.show', $course) }}">
                {{ $course->name }}
            </x-link>
            <div class="font-opensans relative text-text flex gap-7.5">
                <span class="flex gap-2 items-center">
                    <i class="fa-solid fa-user text-light-gray text-[17px]"></i> {{ $course->students_limit }} Students
                </span>
                <span>
                    <i class="fa-solid fa-file-lines text-light-gray text-[17px]"></i> 4 Lectures
                </span>
            </div>
        </div>
        <div class="border-t border-light-gray p-5 flex items-center gap-3">
            <a href="{{ route('teachers.show', ['teacher'=>$course->teacher->id]) }}">
                <img alt="Teacher image" src="{{ $course->teacher->profile->avatar }}" class="rounded-full w-12 h-12" />
            </a>
            <a href="{{ route('teachers.show', ['teacher'=>$course->teacher->id]) }}" class="text-primary font-semibold hover:text-secondary transition">
                {{ $course->teacher->name }}
            </a>
        </div>
    </div>
</li>
