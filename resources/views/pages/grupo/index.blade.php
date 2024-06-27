<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <x-breadcrumbs :breadcrumbs="[['nombre' => 'Lista de grupos', 'href' => route('admin.grupo.index')]]" />
        <div class="mb-3">
            {{-- <h5 class="text-xl font-semibold mb-4">Gestionar Grupos</h5> --}}
            <x-link-button href="{{ route('admin.grupo.create') }}">
                Nuevo grupo
            </x-link-button>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="grupo_id" class="block text-sm font-medium text-gray-700">Niveles</label>
                    <select name="grupo_id" id="grupo_id"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="all">Todos los grupos</option>
                        @foreach ($niveles as $nivel)
                            <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="grupo_id" class="block text-sm font-medium text-gray-700">Buscar</label>
                    <input type="text" id="buscarGrupo" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Buscar por nombre de grupo...">
                </div>
            </div>  

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4" id="grupos-container">
                @foreach ($grupos as $grupo)
                    <div class="grupo-card">
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <img src="{{ $grupo->foto }}" class="w-full h-48 object-cover" alt="...">
                            <div class="p-6">
                                <h5 class="text-lg font-semibold">{{ $grupo->nombre }}</h5>
                                <p class="mt-2 text-gray-600">{{ $grupo->descripcion }}</p>
                                <div class="flex justify-end w-full mt-4">
                                    <x-link-button-secondary href="{{ route('admin.grupo.show', $grupo->id) }}">
                                        Ingresar
                                    </x-link-button-secondary>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        @if (session('mensaje'))
            <script>
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("{{ session('mensaje') }}");
            </script>
        @endif

        @if (session('error'))
            <script>
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error("{{ session('error') }}");
            </script>
        @endif

        {{-- js --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const grupoSelect = document.getElementById('grupo_id');
                grupoSelect.addEventListener('change', function() {
                    var nivelId = this.value;
                    fetch(`/api/grupos/${nivelId}`)
                        .then(response => response.json())
                        .then(data => {
                            const container = document.getElementById('grupos-container');
                            container.innerHTML = '';
                            data.forEach(grupo => {
                                const ingresarUrl = `{{ route('admin.grupo.show', ':grupo_id') }}`
                                    .replace(':grupo_id', grupo.id);
                                const grupoCard = `
                                    <div class="grupo-card col-span-1">
                                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                            <img src="${grupo.foto}" class="w-full h-48 object-cover" alt="...">
                                            <div class="p-6">
                                                <h5 class="text-lg font-semibold">${grupo.nombre}</h5>
                                                <p class="mt-2 text-gray-600">${grupo.descripcion}</p>
                                                  <div class="flex justify-end w-full mt-4">
                                <x-link-button-secondary href="${ingresarUrl}">
                                    Ingresar
                                </x-link-button-secondary>
                            </div>
                                            </div>
                                        </div>
                                    </div>`;
                                container.insertAdjacentHTML('beforeend', grupoCard);
                            });
                        })
                        .catch(error => alert('Error al obtener los grupos.'));
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#buscarGrupo').on('input', function() {
                    var valorBusqueda = $(this).val().trim().toLowerCase();
                    $('.grupo-card').each(function() {
                        var nombreGrupo = $(this).find('.text-lg').text().toLowerCase();
                        if (nombreGrupo.includes(valorBusqueda)) {
                            $(this).show(); // Mostrar grupo si coincide con el nombre buscado
                        } else {
                            $(this).hide(); // Ocultar grupo si no coincide con el nombre buscado
                        }
                    });
                });

                // Manejar el caso cuando el input de búsqueda está vacío
                $('#buscarGrupo').on('keyup', function() {
                    if ($(this).val().trim() === '') {
                        $('.grupo-card').show(); // Mostrar todos los grupos si el input está vacío
                    }
                });
            });
        </script>
    </div>
</x-app-layout>
