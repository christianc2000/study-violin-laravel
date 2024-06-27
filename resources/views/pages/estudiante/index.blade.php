<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl">
        <div class="mb-3">
            <x-breadcrumbs :breadcrumbs="[['nombre' => 'Lista de estudiantes', 'href' => route('admin.estudiante.index')]]" />
            <x-link-button href="{{ route('admin.estudiante.create') }}">
                Nuevo estudiante
            </x-link-button>
            <div class="mt-4">
                <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col"
                                class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400 cursor-pointer"
                                id="sort-id">
                                <div class="flex items-center gap-x-3">
                                    <span>ID</span>
                                    <i class="fa fa-sort px-2" aria-hidden="true" id="sort-icon"></i>
                                </div>
                            </th>

                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Estudiante
                            </th>

                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Género
                            </th>

                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Edad
                            </th>

                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Puntaje
                            </th>
                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Nivel
                            </th>
                            <th scope="col" class="relative py-3.5 px-4">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                        @foreach ($estudiantes as $estudiante)
                            <tr id="{{ $estudiante->id }}">
                                <td
                                    class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                    {{ $estudiante->id }}</td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                    <div class="flex items-center gap-x-2">
                                        <img class="object-cover w-10 h-10 rounded-full"
                                            src="{{ $estudiante->user->image }}" alt="">
                                        <div class="ml-2">
                                            <h2 class="text-sm font-medium text-gray-600 dark:text-white ">
                                                {{ $estudiante->user->name . ' ' . $estudiante->user->lastname }}
                                            </h2>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">
                                                {{ $estudiante->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                    {{ $estudiante->user->gender }}</td>
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300 whitespace-nowrap">
                                    {{ $estudiante->user->age }}
                                </td>
                                <td class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                    {{ $estudiante->puntuacion }}</td>
                                <td class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                    {{ $estudiante->niveles->nombre }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button id="myButton" class="dropbtn">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                            </svg>
                                        </button>
                                        <div id="myDropdown" class="dropdown-content">
                                            <a href="{{ route('admin.estudiante.perfil', $estudiante->id) }}"
                                                class="text-sm font-normal hover:bg-gray-200">Perfil</a>
                                            @role('profesor')
                                                <a href="{{ route('admin.estudiante.tutor', $estudiante->id) }}"
                                                    class="text-sm font-normal hover:bg-gray-200">Tutor</a>
                                            @endrole
                                            <button type="button" data-estudiante-id="{{ $estudiante->id }}"
                                                data-estudiante-name="{{ $estudiante->user->name . ' ' . $estudiante->user->lastname }}"
                                                data-user-id="{{ Auth::user()->id }}"
                                                class="text-sm font-normal deleteBtn hover:bg-gray-200">Desvincular</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>
    <!-- Contenido del modal -->
    <div id="myModal" class="fixed z-50 inset-0 flex items-center justify-center" style="display: none;"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Fondo del modal -->
        <div class="absolute inset-0 bg-gray-500 bg-opacity-50 transition-opacity"
            style="background-color: rgba(0, 0, 0, 0.5);" aria-hidden="true"></div>

        <!-- Contenido del modal -->
        <div
            class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title"></h3>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6">
                <form action="" id="form-desvincular" method="POST" class="flex justify-end">
                    @csrf
                    <input type="hidden" id="estudiante_id" name="estudiante_id">
                    <input type="hidden" id="user_id" name="user_id">
                    <button id="confirmDelete" type="submit"
                        class="w-32 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 mr-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Confirmar
                    </button>

                    <button id="cancelDelete" type="button"
                        class="w-32 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        /* Estilos para el botón y el contenido del menú desplegable */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            /* Alinea el borde derecho del contenido con el borde derecho del botón */
            min-width: 160px;
            z-index: 1;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            background-color: #f9f9f9;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content button {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Muestra el menú desplegable cuando se hace clic en el botón */
        .show {
            display: block;
        }

        .btn-activo {
            background-color: #f3f4f6;
            /* color de fondo cuando está activo */
            color: #374151;
            /* color del texto cuando está activo */
        }
    </style>
    {{-- css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    {{-- js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @if (session('success'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            console.log("ingresa a success");
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            console.log("ingresa a error")
            toastr.error("{{ session('error') }}");
        </script>
    @endif
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    <script>
        // Obtén todos los menús desplegables
        var dropdowns = document.getElementsByClassName("dropbtn");

        // Agrega un evento de clic a cada botón
        for (let i = 0; i < dropdowns.length; i++) {
            dropdowns[i].addEventListener("click", function(event) {
                event.stopPropagation();

                // Encuentra el contenido del menú desplegable correspondiente
                var dropdownContent = this.nextElementSibling;

                // Cierra todos los menús desplegables abiertos
                for (let j = 0; j < dropdowns.length; j++) {
                    var openDropdown = dropdowns[j].nextElementSibling;
                    if (openDropdown !== dropdownContent && openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }

                // Muestra u oculta el contenido del menú desplegable
                dropdownContent.classList.toggle("show");
            });
        }

        // Cierra todos los menús desplegables cuando se hace clic fuera de ellos
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (let i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        let sortOrder = 'asc';

        $('#sort-id').click(function() {
            let rows = $('tbody tr').get();

            rows.sort(function(a, b) {
                let keyA = parseInt($(a).attr('id'));
                let keyB = parseInt($(b).attr('id'));

                if (sortOrder === 'asc') {
                    return (keyA < keyB) ? -1 : (keyA > keyB) ? 1 : 0;
                } else {
                    return (keyA > keyB) ? -1 : (keyA < keyB) ? 1 : 0;
                }
            });

            $.each(rows, function(index, row) {
                $('tbody').append(row);
            });

            // Toggle the sortOrder
            sortOrder = (sortOrder === 'asc') ? 'desc' : 'asc';

            // Update the sort icon
            $('#sort-icon').removeClass('fa-sort fa-sort-up fa-sort-down');
            if (sortOrder === 'asc') {
                $('#sort-icon').addClass('fa-sort-up');
            } else {
                $('#sort-icon').addClass('fa-sort-down');
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Evento de clic en el botón "Desvincular"
            $(document).on('click', '.deleteBtn', function(e) {
                e.preventDefault();
                console.log("Click en eliminar estudiante");

                // Obtiene los datos del estudiante
                var estudianteId = $(this).data('estudiante-id');
                var estudianteName = $(this).data('estudiante-name');
                var userId = $(this).data('user-id');

                console.log('ID estudiante: ', estudianteId);
                console.log('Nombre estudiante: ', estudianteName);
                console.log('ID profesor: ', userId);

                // Asigna los datos al formulario
                $('#estudiante_id').val(estudianteId);
                $('#user_id').val(userId);
                var route = "{{ route('admin.estudiante.desvincular') }}";
                $('#form-desvincular').attr('action', route);
                // Actualiza el título del modal
                $('#modal-title').text('¿Estás seguro de que quieres desvincular al estudiante ' +
                    estudianteName + '?');

                // Muestra el modal
                $('#myModal').show();
            });

            // Evento de clic en el botón "Cancelar"
            $('#cancelDelete').on('click', function() {
                $('#myModal').hide();
            });
        });
    </script>
</x-app-layout>
