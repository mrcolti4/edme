@props(['width', 'size' => 'xs', 'hovarble' => false])
<span @class([
    'star relative text-gray-300 after:font-fontAwesome after:absolute after:top-0 after:left-0 after:content-[\'\\f005\']  after:text-yellow-400 after:overflow-hidden fa fa-star',
    'text-xs' => $size === 'xs',
    'text-lg' => $size === 'lg',
    'hovarble' => 'hover-star'
    ])
    style="--width: {{$width}}%"
    {{$attributes()}}
>
    {{$slot}}
</span>
