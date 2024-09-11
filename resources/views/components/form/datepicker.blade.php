@php
    $date = Carbon\Carbon::now()->month;
    $years = range(Carbon\Carbon::now()->year, Carbon\Carbon::now()->year + 5);
@endphp
<div>
    <div>
        <div>
            <x-form.label>
                Year
                <select>
                    @foreach ($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </x-form.label>
        </div>
        <div></div>
    </div>
    <div></div>
</div>
