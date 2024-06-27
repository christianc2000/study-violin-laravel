@props(['id', 'name', 'type' => 'text', 'value' => ''])

<input {{ $attributes->merge(['class' => 'form-input w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500']) }} type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}">