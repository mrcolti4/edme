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
            <div class="flex items-center border border-gray-300 rounded-xl bg-white mb-6 gap-4 py-2 px-4">
                @foreach (App\Enums\FilterBookings::cases() as $case)
                    <label for="{{ $case->value }}">
                        {{ $customButtonNames[$case->value] }}
                    </label>
                    <input
                        id="{{ $case->value }}"
                        type="radio"
                        wire:model="filter"
                        wire:change="$refresh"
                        value={{ $case }}
                        @click="activeFilter = '{{ $case->value }}'"
                        :class="{ 'border-blue-500': activeFilter === '{{ $case->value }}' }"
                        />
                @endforeach
            </div>
            <div class="flex items-center border border-gray-300 rounded-xl bg-white mb-6 gap-4 py-2 px-4">
                <label for="{{ App\Enums\Direction::DESC->value }}">
                    {{__('High to Low')}}
                </label>
                <input 
                    type="radio"
                    wire:model="order"
                    wire:change="$refresh"
                    id="{{ App\Enums\Direction::DESC->value }}"
                    @click="orderByDirection = '{{ App\Enums\Direction::DESC->value }}'"
                    value={{ App\Enums\Direction::DESC->value }}
                    :class="{ 'border-blue-500': orderByDirection === '{{ App\Enums\Direction::DESC->value }}' }"
                />
                <label for="{{ App\Enums\Direction::ASC->value }}">
                    {{__('Low to High')}}
                </label>
                <input 
                    type="radio"
                    wire:model="order"
                    wire:change="$refresh"
                    id="{{ App\Enums\Direction::ASC->value }}"
                    @click="orderByDirection = '{{ App\Enums\Direction::ASC->value }}'"
                    value={{ App\Enums\Direction::ASC->value }}
                    :class="{ 'border-b-2 border-blue-500': orderByDirection === '{{ App\Enums\Direction::ASC->value }}' }"
                />
            </div>
        </div>
    @endif
    <ul class="my-6">
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
                            "bg-gray-500" => $booking->status === 'expired',
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
    {{ $bookings->links() }}
</div>
