@php
    $customButtonNames = [
        'created_at' => 'Order by date',
        'price' => 'Order by price',
        'status' => 'Order by status',
    ];
@endphp

<div x-data="{ activeFilter: 'created_at', orderByDirection: 'asc' }">
    @if ($bookings->count() > 0)
        <div class="flex justify-between items-center">
            <div class="flex items-center border border-gray-300 rounded-xl bg-white mb-6">
                @foreach (App\Enums\FilterBookings::cases() as $case)
                    <button 
                        wire:click="orderByFilter('{{ $case }}')" 
                        @click="activeFilter = '{{ $case->value }}'" 
                        :class="{ 'border-b-2 border-blue-500': activeFilter === '{{ $case->value }}' }" 
                        class="px-4 py-2">
                        {{ $customButtonNames[$case->value] }}
                    </button>
                @endforeach
            </div>
            <div class="flex items-center border border-gray-300 rounded-xl bg-white mb-6">
                <button 
                    wire:click="orderByDirection('{{ App\Enums\Direction::DESC }}')" 
                    @click="orderByDirection = '{{ App\Enums\Direction::DESC->value }}'"
                    class="px-4 py-2"
                    :class="{ 'border-b-2 border-blue-500': orderByDirection === '{{ App\Enums\Direction::DESC->value }}' }"
                >
                    {{__('Low to high')}}
                </button>
                <button 
                    wire:click="orderByDirection('{{ App\Enums\Direction::ASC }}')" 
                    @click="orderByDirection = '{{ App\Enums\Direction::ASC->value }}'"
                    class="px-4 py-2"
                    :class="{ 'border-b-2 border-blue-500': orderByDirection === '{{ App\Enums\Direction::ASC->value }}' }"
                >
                    {{__('High to low')}}
                </button>
            </div>
        </div>
    @endif
    <ul class="mt-6">
        @forelse ($bookings as $booking)
            <li class="mt-3 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{$booking->course->image}}" alt="{{$booking->course->name}}" class="w-16 h-16 object-cover rounded-md">
                    <h3 class="text-lg font-semibold">
                        <a href="{{ route('courses.show', ['course' => $booking->course_id]) }}">
                            {{ $booking->course->name }}
                        </a>
                    </h3>
                </div>
                <div class="flex items-center gap-5">
                    <p class="text-gray-500 font-bold">Price: ${{ $booking->course->price }}</p>
                    <div class="flex flex-col gap-2">
                        <p class="text-sm text-gray-500">{{ $booking->created_at->format('d M Y, H:i') }}</p>
                        <p
                        @class([
                            "text-sm text-center text-white py-1 px-2 rounded-md",
                            "bg-yellow-500" => $booking->status === 'pending',
                            "bg-secondary" => $booking->status === 'paid',
                            "bg-red-500" => $booking->status === 'cancelled',
                        ])>
                            {{ $booking->status }}
                        </p>
                    </div>
                </div>
            </li>
        @empty
            <li class="mt-3">
                {{__("You haven't booked any courses yet")}}
            </li>
        @endforelse
    </ul>
</div>
