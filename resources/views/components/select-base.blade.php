@props(['id', 'name'])

<select {{ $attributes->merge(['class' => 'form-select w-full']) }} id="{{ $id }}" name="{{ $name }}">
    {{ $slot }}
</select>