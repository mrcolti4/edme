@props(['name', 'xText' => '', 'placeholder' => ''])

<label x-model="form.{{ $name }}">
    <input @blur="$dispatch('validate', {name: '{{ $name }}', value: $event.target.value })"
        name="{{ $name }}" />
    <span x-cloak x-bind="showError('{{ $name }}')"></span>
</label>
