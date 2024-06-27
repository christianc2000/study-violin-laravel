@props(['id', 'name'])

<select {{ $attributes->merge(['class' => 'form-select w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500']) }} id="{{ $id }}" name="{{ $name }}">
    {{ $slot }}
</select>