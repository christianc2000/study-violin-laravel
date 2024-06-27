<!-- resources/views/components/breadcrumbs.blade.php -->

@php
    // Obtener la URL actual
    $currentUrl = url()->current();
@endphp

<div class="w-full text-left">
    <nav aria-label="breadcrumb" class="block w-full">
        <ol class="flex w-full flex-wrap items-center rounded-md bg-opacity-60 py-2">
            @foreach ($breadcrumbs as $breadcrumb)
                @php
                    // Determinar si el breadcrumb actual está activo
                    $isActive = $currentUrl == $breadcrumb['href'];
                    $classes =
                        'breadcrumb-item flex cursor-pointer items-center font-sans text-lg font-normal leading-normal text-blue-900 antialiased transition-colors duration-300 hover:text-pink-500';
                    if ($isActive) {
                        $classes .= ' font-medium text-indigo-700'; // Estilos adicionales para activo
                    }
                @endphp
                <li class="{{ $classes }}">
                    <a class="opacity-60" href="{{ $breadcrumb['href'] }}">
                        <span>{{ $breadcrumb['nombre'] }}</span>
                    </a>
                    @if (!$loop->last)
                        <span
                            class="separator pointer-events-none mx-2 select-none font-sans text-lg font-normal leading-normal text-blue-gray-500 antialiased ml-2 mr-2">
                            | {{-- Espacio antes y después del separador --}}
                        </span>
                    @endif
                </li>
            @endforeach
        </ol>

    </nav>
</div>
