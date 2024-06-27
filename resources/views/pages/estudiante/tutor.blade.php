<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl">
        {{-- <h5 class="text-2xl font-semibold mb-4">Agregar Estudiante</h5> --}}
        @php
            $titulo = 'Tutor de ' . $estudiante->user->name . ' ' . $estudiante->lastname;
        @endphp
        <x-breadcrumbs :breadcrumbs="[
            ['nombre' => 'Lista de estudiantes', 'href' => route('admin.estudiante.index')],
            ['nombre' => $titulo, 'href' => route('admin.estudiante.tutor', $estudiante->id)],
        ]" />
        <div class="grid grid-cols-1 gap-6">
            <div class="mb-3">
                @if (isset($estudiante->tutor))
                    @php
                        $tutor = $estudiante->tutor;
                    @endphp
                    <div class="bg-white rounded-lg shadow-xl pb-8 mb-4">
                        <div class="flex flex-col items-center" style="padding: 32px;">
                            <img src="{{ $tutor->user->image }}" class="border-4 border-white rounded-full"
                                style="width: 150px; height: 150px;">
                            <div class="flex items-center space-x-2 mt-2">
                                <p class="text-2xl">
                                    {{ $tutor->user->name . ' ' . $tutor->user->lastname }}</p>
                            </div>
                            <p class="text-gray-700">{{ $tutor->user->email }}</p>
                            {{-- <p class="flex text-sm text-gray-500">
                                {{ $tutor->puntuacion . ' puntos' }}
                            </p> --}}
                            <div class="flex-1 flex flex-col items-center lg:items-end justify-end px-8 mt-2">
                                <div class="flex items-center space-x-4 mt-2">
                                    <a href="{{ route('admin.estudiante.perfil', $estudiante->id) }}"
                                        class="flex items-center bg-blue-600 hover:bg-blue-700 text-gray-100 px-4 py-2 rounded text-sm space-x-2 transition duration-100">
                                        <svg fill="currentColor" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            width="800px" height="800px" viewBox="0 0 52 52"
                                            enable-background="new 0 0 52 52" xml:space="preserve">
                                            <path d="M50,43v2.2c0,2.6-2.2,4.8-4.8,4.8H6.8C4.2,50,2,47.8,2,45.2V43c0-5.8,6.8-9.4,13.2-12.2
 c0.2-0.1,0.4-0.2,0.6-0.3c0.5-0.2,1-0.2,1.5,0.1c2.6,1.7,5.5,2.6,8.6,2.6s6.1-1,8.6-2.6c0.5-0.3,1-0.3,1.5-0.1
 c0.2,0.1,0.4,0.2,0.6,0.3C43.2,33.6,50,37.1,50,43z M26,2c6.6,0,11.9,5.9,11.9,13.2S32.6,28.4,26,28.4s-11.9-5.9-11.9-13.2
 S19.4,2,26,2z" />
                                        </svg>
                                        <span>Perfil del estudiante</span>
                                    </a>
                                    <button type="button" onclick="openModal()" id="btnAdd" data-estudiante="{{ $estudiante->id }}"
                                        class="flex items-center bg-blue-600 hover:bg-blue-700 text-gray-100 px-4 py-2 rounded text-sm space-x-2 transition duration-100">
                                        <svg class="h-4 w-4" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor">
                                            <path
                                                d="m27.3 37.6c-3-1.2-3.5-2.3-3.5-3.5 0-1.2 0.8-2.3 1.8-3.2 1.8-1.5 2.6-3.9 2.6-6.4 0-4.7-2.9-8.5-8.3-8.5s-8.3 3.8-8.3 8.5c0 2.5 0.8 4.9 2.6 6.4 1 0.9 1.8 2 1.8 3.2 0 1.2-0.5 2.3-3.5 3.5-4.4 1.8-8.6 3.8-8.7 7.6 0.2 2.6 2.2 4.8 4.7 4.8h23c2.5 0 4.5-2.2 4.5-4.7-0.1-3.8-4.3-5.9-8.7-7.7z m17.2-18.6c0-7.4-6.1-13.5-13.5-13.5v-3.5l-6.8 5.5c-0.3 0.3-0.2 0.8 0.1 1.1l6.7 5.4v-3.5c4.7 0 8.5 3.8 8.5 8.5h-3.5l5.5 6.8c0.3 0.3 0.8 0.3 1.1 0l5.4-6.8h-3.5z">
                                            </path>
                                        </svg>
                                        <span>Cambiar tutor</span>
                                    </button>
                                    <button id="delete-tutor" data-estudiante-id="{{ $estudiante->id }}"
                                        class="flex items-center bg-blue-600 hover:bg-blue-700 text-gray-100 px-4 py-2 rounded text-sm space-x-2 transition duration-100">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z"
                                                fill="currentColor" />
                                        </svg>
                                        <span>Eliminar tutor</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="my-4 mb-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
                        <div class="w-full flex flex-col 2xl:w-1/3">
                            <div class="flex-1 bg-white rounded-lg shadow-xl" style="padding: 32px">
                                <h4 class="text-xl text-gray-900 font-bold">Información Personal</h4>
                                <ul class="mt-2 text-gray-700">
                                    <li class="flex border-b py-2">
                                        <span class="font-bold w-24 text-sm mr-1">CI: </span>
                                        <span class="text-gray-700 font-normal text-sm">{{ $tutor->user->ci }}</span>
                                    </li>
                                    <li class="flex border-b py-2">
                                        <span class="font-bold w-24 text-sm mr-1">Nombre completo: </span>
                                        <span
                                            class="text-gray-700 font-normal text-sm">{{ $tutor->user->name . ' ' . $tutor->user->lastname }}</span>
                                    </li>
                                    <li class="flex border-b py-2">
                                        <span class="font-bold w-24 text-sm mr-1">Fecha de nacimiento: </span>
                                        <span
                                            class="text-gray-700 font-normal text-sm">{{ $tutor->user->birth_date }}</span>
                                    </li>
                                    <li class="flex border-b py-2">
                                        <span class="font-bold w-24 text-sm mr-1">Fecha agregado: </span>
                                        <span
                                            class="text-gray-700 font-normal text-sm">{{ $tutor->created_at->format('M d, Y') }}</span>
                                    </li>
                                    <li class="flex border-b py-2">
                                        <span class="font-bold w-24 text-sm mr-1">Correo: </span>
                                        <span class="text-gray-700 font-normal text-sm">{{ $tutor->user->email }}</span>
                                    </li>
                                    <li class="flex border-b py-2">
                                        <span class="font-bold w-24 text-sm mr-1">Dirección: </span>
                                        <span
                                            class="text-gray-700 font-normal text-sm">{{ $tutor->user->address }}</span>
                                    </li>
                                    <li class="flex border-b py-2">
                                        <span class="font-bold w-24 text-sm mr-1">Género:</span>
                                        <span
                                            class="text-gray-700 font-normal text-sm">{{ $tutor->user->gender == 'M' ? 'Masculino' : 'Femenino' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow-xl p-4 mb-4 text-center text-gray-500">
                        <p class="text-sm font-normal text-gray-800">No tiene tutor asignado</p>
                        <div class="flex justify-center mt-4">
                            <button type="button" onclick="openModal()" id="btnAdd"
                                data-estudiante="{{ $estudiante->id }}"
                                class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold text-xs uppercase tracking-widest rounded-md transition">
                                <!-- License: MIT. Made by vmware: https://github.com/vmware/clarity-assets -->
                                <svg class="w-4 h-4" fill="#ffffff" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 4a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2h-6v6a1 1 0 1 1-2 0v-6H5a1 1 0 1 1 0-2h6V5a1 1 0 0 1 1-1z" />
                                </svg>
                                <span class="">Asignar tutor</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Contenido del modal -->
    <div id="deleteMyTutor" class="fixed z-50 inset-0 flex items-center justify-center" style="display: none;"
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
                <form action="" id="form-delete-tutor" method="POST" class="flex justify-end">
                    @csrf
                    <input type="hidden" id="estudiante_id" name="estudiante_id">
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
    {{-- MODAL ASIGNAR TUTOR --}}
    <div class="main-modal fixed w-full h-full inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
        style="background: rgba(0,0,0,.7); display: none;">
        <div
            class="border border-teal-500 modal-container bg-white w-1/2 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Asignar tutor</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                            height="18" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>
                <form id="addTutorForm" method="POST" action="{{ route('admin.estudiante.tutor.store') }}">
                    <!--Body-->
                    <div class="mb-5 mt-2 body-modal h-full">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                            <div class="col-span-full">

                                @csrf
                                <input type="hidden" id="estudiante_modal" name="estudiante_modal">
                                <div class="mb-3" id="divSelect">
                                    <label for="tutor_id" class="form-label">Tutores</label>
                                    <x-select id="tutor_id" name="tutor_id">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($tutores as $tutor)
                                            <option value="{{ $tutor->id }}">
                                                {{ $tutor->user->name . ' ' . $tutor->user->lastname . ' - CI ' . $tutor->user->ci }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    <span id="tutor_idError" class="text-sm font-medium text-red-500"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--Footer-->
                    <div class="flex justify-end pt-2">
                        <button
                            class="focus:outline-none modal-close btn bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 hover:border-slate-300 dark:hover:border-slate-600 text-slate-600 dark:text-slate-300">Cancelar</button>
                        <x-button class="ml-2">
                            <i class="ti ti-plus"></i> Agregar
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        <style>.modal-container {
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
    <script>
        $(document).ready(function() {
            $('#addTutorForm').on('submit', function(event) {
                event.preventDefault(); // Evitar el envío del formulario

                var isValid = true;
                var tutorId = $('#tutor_id').val();

                // Limpiar mensajes de error anteriores
                $('#tutor_idError').text('');

                // Validar campo tutor_id
                if (tutorId === "") {
                    $('#tutor_idError').text('Por favor, seleccione un tutor.');
                    isValid = false;
                }

                // Si el formulario es válido, enviarlo
                if (isValid) {
                    this.submit();
                }
            });

            $(document).on('click', '#delete-tutor', function(e) {
                e.preventDefault();
                console.log("Click en eliminar tutor");

                // Obtiene los datos del estudiante
                var estudianteId = $(this).data('estudiante-id');
                var estudianteName = $(this).data('estudiante-name');

                console.log('ID estudiante: ', estudianteId);
                console.log('Nombre estudiante: ', estudianteName);


                // Asigna los datos al formulario
                $('#estudiante_id').val(estudianteId);
                var route = "{{ route('admin.estudiante.tutor.delete') }}";
                $('#form-delete-tutor').attr('action', route);
                // Actualiza el título del modal
                $('#modal-title').text(
                    '¿Estás seguro de que quieres eliminar el tutor para el estudiante ' +
                    estudianteName + '?');

                // Muestra el modal
                $('#deleteMyTutor').show();
            });

            // Evento de clic en el botón "Cancelar"
            $('#cancelDelete').on('click', function() {
                $('#deleteMyTutor').hide();
            });

            // Evento al cerrar el modal
            $('.modal-close').on('click', function() {
                $('.main-modal').fadeOut();
            });

            if ($(event.target).closest('.modal-container').length === 0 && $(event.target).closest('#btnAdd')
                .length === 0) {
                closeModal();
            }
        });
    </script>
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
            var estudianteId = $('#btnAdd').data('estudiante');
            $('#estudiante_modal').val(estudianteId);
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
