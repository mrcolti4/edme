@props(['status'])

<div
    x-data="{ show: true }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90"
    @class([
        "fixed bottom-4 left-4 flex items-center px-7 py-4 mb-4 rounded-lg  border-l-8 bg-green-100 border-green-500 text-green-700 bg-primary text-white z-20 font-bold",
        "border-l-red-500" => $status === "error",
        "border-l-secondary" => $status === "success"
    ])
>
    <div class="flex-1">
        {{$slot}}
    </div>
    <button
        @click="show = false"
        class="ml-4 p-1 hover:bg-black hover:bg-opacity-10 rounded-full transition-colors"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
</div>
