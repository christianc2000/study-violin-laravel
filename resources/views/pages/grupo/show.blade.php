<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        @php
            $titulo = '' . $grupo->nombre;
        @endphp
        <x-breadcrumbs :breadcrumbs="[
            ['nombre' => 'Lista de grupos', 'href' => route('admin.grupo.index')],
            ['nombre' => $titulo, 'href' => route('admin.grupo.show', $grupo->id)],
        ]" />
        <div class="mb-3">
            {{-- <h5 class="text-xl font-semibold mb-4">Bienvenido al grupo "{{ $grupo->nombre }}"</h5> --}}
            @role('profesor')
                <button type="button" onclick="openModal()"
                    class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold text-xs uppercase tracking-widest rounded-md transition">
                    Agregar estudiante
                </button>
            @endrole
        </div>
        <div class="max-w-sm">
            <div class="bg-white shadow-lg rounded-lg">
                <div class="w-full flex justify-between items-center p-3" style="background: #828282; color: white;">
                    <p class="text-sm font-medium">Estudiantes</p>
                    <div>
                        <x-link-button-secondary href="{{ route('admin.grupo.chat', $grupo->id) }}">
                            Ir a chat
                        </x-link-button-secondary>
                    </div>
                </div>

                <ul class="grid grid-cols-1 sm:grid-cols-2 divide-y divide-gray-200">
                    @if ($estudiantes->isEmpty())
                        <p class="text-center text-gray-600 p-4">No hay estudiantes registrados.</p>
                    @else
                        @foreach ($estudiantes as $estudiante)
                            <li class="p-3 flex justify-between items-center user-card">
                                <div class="flex items-center">
                                    <img class="w-10 h-10 rounded-full" src="{{ $estudiante->user->image }}"
                                        alt="{{ $estudiante->user->name }}">
                                    <span
                                        class="ml-3 text-sm font-medium">{{ $estudiante->user->name . ' ' . $estudiante->user->lastname }}</span>
                                </div>
                                <div>
                                    <a class="text-gray-500 hover:text-gray-700"
                                        href="{{ route('admin.estudiante.perfil', $estudiante->user->id) }}">
                                        <svg width="800px" height="800px" class="h-6 w-6" viewBox="-10 -5 1034 1034"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
                                            <path fill="#828282"
                                                d="M495 226q-27 0 -54 5l-7 1l-49 116l-117 -48q-53 38 -90 89l-4 5l48 117l-117 48q-10 64 -1 126l2 7l116 49l-48 116q18 25 36 45l13 12q19 19 45 38l117 -49l48 117l7 1q63 10 126 0l49 -118l117 49l5 -4q52 -38 89 -90l-49 -117l117 -48l1 -7q10 -63 0 -126l-117 -49
                                                l48 -116q-20 -28 -41 -49l-7 -7q-20 -19 -47 -39l-116 49l-48 -117q-36 -6 -72 -6zM500 325q11 0 22 1l51 123v0l124 -51l15 15q10 10 15 16l-51 123l1 1v0l123 51q2 21 0 44l-123 51v0v0l51 124q-14 16 -31 31l-123 -51h-1v0l-51 123q-21 1 -44 0l-51 -123v0v-1l-124 52
                                                l-27 -27l-4 -4l51 -123v-1v0l-123 -51q-1 -23 0 -44l123 -51v0l-51 -124q15 -17 31 -31l123 51h1l51 -123q11 -1 22 -1zM500 450q-6 0 -13 1l-29 72l-73 -30l-18 18l30 72l-72 30v25l72 30l-30 73q8 9 19 18l71 -30l30 72q13 1 26 0l30 -72v0l72 30q9 -8 18 -18l-30 -72
                                                l72 -30l1 -13l-1 -13l-72 -30l30 -72q-7 -9 -18 -18l-72 30l-30 -72zM500 577q20 0 34.5 14.5t14.5 34.5t-14.5 34t-34.5 14t-34 -14t-14 -34t14 -34.5t34 -14.5z" />
                                        </svg>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="main-modal fixed w-full h-full inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
        style="background: rgba(0,0,0,.7); display: none;">
        <div
            class="border border-teal-500 modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Añadir estudiante</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                            height="18" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>
                <!--Body-->
                <div class="mb-5 mt-2 body-modal h-full">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                        <div class="col-span-full">
                            <label for="titulo" class="block text-sm font-medium leading-6 text-gray-900">Buscar
                                estudiante</label>

                            <div class="flex flex-col items-center relative">
                                <div class="w-full">
                                    <input placeholder="Buscar por el nombre o apellido o correo del usuario"
                                        id="search"
                                        class="my-2 p-1 px-2 appearance-none outline-none w-full h-10 text-gray-800 flex border border-gray-200 rounded">
                                </div>
                                <div id="searchList"
                                    class="absolute shadow bg-white top-full z-40 w-full rounded mt-1 overflow-hidden"
                                    style="display: none;">
                                    <div class="flex flex-col w-full" id="divSearch">
                                        {{-- Resultados de búsqueda se insertarán aquí --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-full">
                            <table id="tb-usuario"
                                class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 font-medium text-gray-900">Estudiante(<span
                                                class="cantidadUsuarios">0</span>)</th>

                                        <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                                    {{-- tr del tbody --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button
                        class="focus:outline-none modal-close btn bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600 text-slate-600 dark:text-slate-300">Cancelar</button>
                    <form id="invitacionForm" method="POST"
                        action="{{ route('admin.grupo.chat.store.estudiante', $grupo->id) }}">
                        @csrf
                        <input type="hidden" id="colaboradores" name="colaboradores">
                        <x-button class="ml-2">
                            <i class="ti ti-plus"></i> Agregar
                        </x-button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    {{-- <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.1.0/dist/flowbite.min.css" /> --}}
    <style>
        .modal-container {
            width: 80%;
            max-width: 100%;
            max-height: 100%;
        }

        .modal-content {
            display: flex;
            flex-direction: column;
            height: 90vh;
            /* Ajusta este valor para cambiar la altura del cuerpo del modal */
        }

        .modal-content .modal-header,
        .modal-content .modal-footer {
            flex-shrink: 0;
            /* Esto hace que el título y el pie de página sean estáticos */
        }


        .body-modal {
            height: 80%;
            /* Ajusta este valor para cambiar la altura */
            overflow-y: auto;
            /* Esto añade un scroll al cuerpo del modal si el contenido es demasiado grande */
        }

        .animated {
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        .animated.faster {
            -webkit-animation-duration: 500ms;
            animation-duration: 500ms;
        }

        .fadeIn {
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
        }

        .fadeOut {
            -webkit-animation-name: fadeOut;
            animation-name: fadeOut;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- <script src="https://unpkg.com/@themesberg/flowbite@1.1.0/dist/flowbite.bundle.js"></script> --}}
    <script>
        $(document).ready(function() {
            let colaboradores = [];

            // Evento al enviar el formulario de invitación
            $('#invitacionForm').on('submit', function() {
                // Convertir el vector de colaboradores a una cadena JSON
                var colaboradoresJson = JSON.stringify(colaboradores);

                // Actualizar el valor del campo oculto con la cadena JSON
                $('#colaboradores').val(colaboradoresJson);
            });

            // Evento al hacer clic fuera del input de búsqueda para cerrar los resultados
            $(document).on('click', function(event) {
                if (!$(event.target).closest('#search').length && !$(event.target).closest('#divSearch')
                    .length) {
                    $('#searchList').hide();
                }
            });

            // Evento de búsqueda al escribir en el input
            $('#search').on('input', function() {
                var query = $(this).val().trim();
                var apiUrl = new URL('/api/search', window.location.origin);

                $.ajax({
                    url: apiUrl.toString(),
                    type: "GET",
                    data: {
                        'query': query,
                        'grupo_id': "{{ $grupo->id }}"
                    },
                    success: function(data) {
                        var html = '';

                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                html += `
                                    <div class="colaborador cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100"
                                        id="${value.id}" data-name="${value.name} ${value.lastname}" data-image="${value.image}"
                                        data-email="${value.email}">
                                        <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                                            <div class="w-6 flex flex-col items-center">
                                                <div class="flex relative w-8 h-8 bg-orange-500 justify-center items-center m-1 mr-2 mt-1 rounded-full">
                                                    <img class="rounded-full w-full h-full object-cover" alt="Avatar" src="${value.image}">
                                                </div>
                                            </div>
                                            <div class="w-full items-center flex">
                                                <div class="mx-2 -mt-1">
                                                    ${value.name} ${value.lastname}
                                                    <div class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500">
                                                        ${value.email}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                            });
                        } else {
                            html += `<div class="p-2 pl-2 border-transparent border-l-2 relative">
                                        <div class="w-full items-center flex">
                                            <div class="mx-2 -mt-1">No se encontraron resultados</div>
                                        </div>
                                    </div>`;
                        }

                        $('#divSearch').html(html);
                        $('#searchList').show();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la solicitud AJAX:', error);
                    }
                });
            });

            // Evento para añadir colaborador al hacer clic en un resultado de búsqueda
            $(document).on('click', '.colaborador', function() {
                const id = $(this).attr('id');
                const image = $(this).data('image');
                const name = $(this).data('name');
                const email = $(this).data('email');

                if (!colaboradores.includes(id)) {
                    colaboradores.push(id);
                    $('.cantidadUsuarios').text(colaboradores.length);

                    // Añadir fila a la tabla de usuarios seleccionados
                    $('#tb-usuario tbody').append(`
                        <tr id="${id}" class="hover:bg-gray-50">
                            <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                <div class="relative h-10 w-10">
                                    <img class="h-full w-full rounded-full object-cover object-center"
                                        src="${image}" alt="${name}" />
                                </div>
                                <div class="text-sm">
                                    <div class="font-medium text-gray-700">${name}</div>
                                    <div class="text-gray-400">${email}</div>
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-4">
                                    <button type="button" class="btn-delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" class="h-6 w-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `);
                }
            });

            // Evento para eliminar colaborador al hacer clic en el botón de eliminar
            $(document).on('click', '.btn-delete', function() {
                var tr = $(this).closest('tr');
                var id = tr.attr('id');

                tr.remove();
                colaboradores = colaboradores.filter(item => item !== id);
                $('.cantidadUsuarios').text(colaboradores.length);
            });

            // Evento al cerrar el modal
            $('.modal-close').on('click', function() {
                $('.main-modal').fadeOut();
            });
        });
    </script>
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
    <script>
        const modal = document.querySelector('.main-modal');
        const closeButton = document.querySelectorAll('.modal-close');

        const modalClose = () => {
            modal.classList.remove('fadeIn');
            modal.classList.add('fadeOut');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 500);
        }

        const openModal = () => {
            modal.classList.remove('fadeOut');
            modal.classList.add('fadeIn');
            modal.style.display = 'flex';
        }

        for (let i = 0; i < closeButton.length; i++) {

            const elements = closeButton[i];

            elements.onclick = (e) => modalClose();

            modal.style.display = 'none';

            window.onclick = function(event) {
                if (event.target == modal) modalClose();
            }
        }
    </script>
</x-app-layout>
