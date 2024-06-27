@props(['id', 'name'])

<textarea {{ $attributes->merge(['class' => 'form-textarea w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500']) }} id="{{ $id }}" name="{{ $name }}">{{ $slot }}</textarea>