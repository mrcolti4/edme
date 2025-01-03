<div>
    <div class="mt-10">
        @if (count($cards) > 0)
        {{$cards}}
            <ul class="grid gap-4">
                @foreach ($cards as $card)
                {{$card}}
                    
                @endforeach
            </ul>
        @else
            <p class="text-primary text-lg font-semibold leading-[33px]">
                {{__("You don't have any credit cards")}}
            </p>
        @endif
    </div>
</div>
