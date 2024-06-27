<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <x-breadcrumbs :breadcrumbs="[
            ['nombre' => 'Lista de grupos', 'href' => route('admin.grupo.index')],
            ['nombre' => 'Agregar grupo', 'href' => route('admin.grupo.create')],
        ]" />
        {{-- <h5 class="text-2xl font-semibold mb-4">Agregar Grupo</h5> --}}

        <form action="{{ route('admin.grupo.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label text-sm font-medium text-gray-800">Nombre</label>
                <x-input-text id="nombre" name="nombre" />
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label text-sm font-medium text-gray-800">Descripción</label>
                <x-textarea id="descripcion" name="descripcion"></x-textarea>
            </div>

            <div class="mb-3">
                <label for="fecha_creacion" class="form-label text-sm font-medium text-gray-800">Fecha de Creación</label>
                <x-input-text id="fecha_creacion" name="fecha_creacion" type="date" />
            </div>

            <div class="mb-3">
                <label for="nivel_id" class="form-label text-sm font-medium text-gray-800">Nivel</label>
                <x-select id="nivel_id" name="nivel_id">
                    @foreach ($niveles as $nivel)
                        <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                    @endforeach
                </x-select>
            </div>

            <input type="hidden" name="profesor_id" value="{{ Auth::id() }}">

            <x-button class="m-1">
                <i class="ti ti-plus"></i> Guardar
            </x-button>
        </form>
    </div>
</x-app-layout>
