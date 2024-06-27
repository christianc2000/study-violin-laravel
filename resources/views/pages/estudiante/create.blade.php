<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl">
        {{-- <h5 class="text-2xl font-semibold mb-4">Agregar Estudiante</h5> --}}
        <x-breadcrumbs :breadcrumbs="[
            ['nombre' => 'Lista de estudiantes', 'href' => route('admin.estudiante.index')],
            ['nombre' => 'Agregar estudiante', 'href' => route('admin.estudiante.create')],
        ]" />
        <div id="opcion">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div id="opcion" class="flex items-center space-x-4 mb-6">
                    @role('profesor')
                        <div class="flex items-center">
                            <input id="nuevo-estudiante" type="radio" name="radioEstudiante" value="1"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" checked>
                            <label for="nuevo-estudiante" class="ml-2 block text-sm font-medium text-gray-800">Nuevo
                                estudiante</label>
                        </div>
                    @endrole
                    <div class="flex items-center ml-4">
                        <input id="old-estudiante" type="radio" name="radioEstudiante" value="2"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" checked>
                        <label for="old-estudiante" class="ml-2 block text-sm font-medium text-gray-800">Estudiante
                            existente</label>
                    </div>
                </div>

                <div id="div-search" class="mb-6" style="display: none">
                    <label for="titulo" class="block text-sm font-medium leading-6 text-gray-800">Buscar
                        estudiante</label>
                    <div class="flex flex-col items-center relative">
                        <div class="w-full">
                            <input placeholder="Buscar por el nombre o apellido o correo del usuario" id="search"
                                class="my-2 p-1 px-2 text-sm font-normal appearance-none outline-none w-full h-10 text-gray-800 flex border border-gray-200 rounded">
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
                <div id="datos-estudiante">
                    <form id="formEstudiante" action="{{ route('admin.estudiante.store') }}" id="formEstudiante"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="radioOpcion" name="radioOpcion">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-3">
                                <label for="ci" class="form-label text-sm font-medium text-gray-800">CI</label>
                                <x-input-text id="ci" name="ci" />
                                <span id="ciError" class="text-sm font-medium text-red-500"></span>
                            </div>
                            <div class="mb-3">
                                <label for="name"
                                    class="form-label text-sm font-medium text-gray-800">Nombre</label>
                                <x-input-text id="name" name="name" />
                                <span id="nameError" class="text-sm font-medium text-red-500"></span>
                            </div>
                            <div class="mb-3">
                                <label for="lastname"
                                    class="form-label text-sm font-medium text-gray-800">Apellido</label>
                                <x-input-text id="lastname" name="lastname" />
                                <span id="lastnameError" class="text-sm font-medium text-red-500"></span>
                            </div>
                            <div class="mb-3" id="divSelect">
                                <label for="gender" class="form-label">Género</label>
                                <x-select id="gender" name="gender">
                                    <option value="">Seleccione una opción</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </x-select>
                                <span id="genderError" class="text-sm font-medium text-red-500"></span>
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label text-sm font-medium text-gray-800">Fecha de
                                    nacimiento</label>
                                <x-input-text id="birth_date" name="birth_date" type="date" />
                                <span id="birthdateError" class="text-sm font-medium text-red-500"></span>
                            </div>
                            <div class="mb-3">
                                <label for="address"
                                    class="form-label text-sm font-medium text-gray-800">Dirección</label>
                                <x-input-text id="address" name="address" />
                                <span id="addressError" class="text-sm font-medium text-red-500"></span>
                            </div>
                            <div class="mb-3" id="divSelect">
                                <label for="nivel" class="form-label">Nivel</label>
                                <x-select id="nivel" name="nivel">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($niveles as $nivel)
                                        <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                                    @endforeach
                                </x-select>
                                <span id="nivelError" class="text-sm font-medium text-red-500"></span>
                            </div>
                            <div class="mb-3">
                                <label for="puntuacion"
                                    class="form-label text-sm font-medium text-gray-800">Puntuación</label>
                                <x-input-text type="number" id="puntuacion" name="puntuacion" />
                                <span id="puntuacionError" class="text-sm font-medium text-red-500"></span>
                            </div>
                            <div class="mb-3">
                                <label for="email"
                                    class="form-label text-sm font-medium text-gray-800">Correo</label>
                                <x-input-text id="email" name="email" type="email" />
                                <span id="emailError" class="text-sm font-medium text-red-500"></span>
                            </div>
                            <div class="mb-3" id="divPassword">
                                <label for="password"
                                    class="form-label text-sm font-medium text-gray-800">Password</label>
                                <x-input-text id="password" name="password" type="password" />
                                <span id="passwordError" class="text-sm font-medium text-red-500"></span>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label text-sm font-medium text-gray-800">Foto de
                                    perfil</label>
                                <div class="flex items-center">
                                    <div id="div-sin-foto"
                                        class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-200 text-gray-600">
                                        <span class="font-normal text-xs p-1">Sin foto</span>
                                    </div>
                                    <input id="foto" name="foto"
                                        class="text-sm font-normal text-gray-600 ml-4" type="file" />

                                </div>
                                <span id="fotoError" class="text-sm font-medium text-red-500"></span>
                            </div>
                        </div>

                        <input type="hidden" name="estudiante_id" id="estudiante_id">
                        <div class="flex justify-end mt-8">
                            {{-- <x-button id="btnAgregar" class="m-1 w-48">
                                Agregar
                            </x-button> --}}
                            <button type="submit"
                                class="btn bg-indigo-500 hover:bg-indigo-600 text-white whitespace-nowrap">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- JS --}}
    <script>
        $(document).ready(function() {

            let estudiantes = [];
            // Set the first radio button to be checked
            $('#nuevo-estudiante').prop('checked', true);
            $('#ciError').hide();
            $('#nameError').hide();
            $('#lastnameError').hide();
            $('#birthdateError').hide();
            $('#genderError').hide();
            $('#addressError').hide();
            $('#fotoError').hide();
            $('#nivelError').hide();
            $('#puntuacionError').hide();
            $('#emailError').hide();
            $('#passwordError').hide();
            $('#radioOpcion').val("1");

            function limpiarInputs() {
                $('#search').val('');
                $('#ci').val('');
                $('#name').val('');
                $('#lastname').val('');
                $('#gender').val('');
                $('#puntuacion').val('');
                $('#nivel').val('');
                $('#birth_date').val('');
                $('#address').val('');
                $('#email').val('');
                $('#password').val('');
            }

            function validarFormulario() {
                let isValid = true;

                // Clear previous error messages
                $('.text-red-500').text('');

                if ($('#ci').val().trim() === '') {
                    $('#ciError').text('El campo CI es obligatorio');
                    $('#ciError').show();
                    isValid = false;
                }
                // Validate name
                if ($('#name').val().trim() === '') {
                    $('#nameError').text('El campo Nombre es obligatorio');
                    $('#nameError').show();
                    isValid = false;
                }

                // Validate lastname
                if ($('#lastname').val().trim() === '') {
                    $('#lastnameError').text('El campo Apellido es obligatorio');
                    $('#lastnameError').show();
                    isValid = false;
                }

                // Validate gender
                if ($('#gender').val() === '') {
                    $('#genderError').text('El campo Género es obligatorio');
                    $('#genderError').show();
                    isValid = false;
                }

                // Validate birth_date
                if ($('#birth_date').val() === '') {
                    $('#birthdateError').text('El campo Fecha de nacimiento es obligatorio');
                    $('#birthdateError').show();
                    isValid = false;
                }

                // Validate address
                if ($('#address').val().trim() === '') {
                    $('#addressError').text('El campo Dirección es obligatorio');
                    $('#addressError').show();
                    isValid = false;
                }
                // Validate puntuacion
                if ($('#puntuacion').val().trim() === '') {
                    $('#puntuacionError').text('El campo Puntuacion es obligatorio');
                    $('#puntuacionError').show();
                    isValid = false;
                }
                // Validate puntuacion
                if ($('#nivel').val().trim() === '') {
                    $('#nivelError').text('El campo Nivel es obligatorio');
                    $('#nivelError').show();
                    isValid = false;
                }
                // Validate email
                const email = $('#email').val().trim();
                if (email === '') {
                    $('#emailError').text('El campo Correo es obligatorio');
                    $('#emailError').show();
                    isValid = false;
                } else if (!validateEmail(email)) {
                    $('#emailError').text('El formato del Correo es inválido');
                    $('#emailError').show();
                    isValid = false;
                }



                if ($('#nuevo-estudiante').is(':checked')) {
                    // Validate password
                    if ($('#password').val().trim() === '') {
                        $('#passwordError').text('El campo Password es obligatorio');
                        $('#passwordError').show();
                        isValid = false;
                    }
                    // Validate foto (optional, if you want to add validation for the file input)
                    if ($('#foto').val() === '') {
                        $('#fotoError').text('El campo Foto de perfil es obligatorio');
                        $('#fotoError').show();
                        isValid = false;
                    }
                }
                return isValid;
            }

            function validateEmail(email) {
                const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                return re.test(email);
            }
            // Función para verificar qué radio está seleccionado y mostrar/ocultar el div-search
            function checkRadioSelection() {
                limpiarInputs();
                $('#div-sin-foto').html(
                    '<span class="font-normal text-xs p-1">Sin foto</span>'
                );
                if ($('#old-estudiante').is(':checked')) {
                    $('#radioOpcion').val("2");
                    // $('#div-search').slideDown(); // Mostrar el div-search
                    $('#div-search').show();
                    // Hacer los campos del formulario readonly
                    $('#datos-estudiante input, #datos-estudiante select, #datos-estudiante textarea').prop(
                        'readonly', true);
                    $('#datos-estudiante input[type="file"]').prop('disabled', false); // Permitir cargar foto
                    $('#gender').prop('disabled', true);
                    $('#divPassword').hide();
                    $('#foto').hide();
                } else {
                    $('#radioOpcion').val("1");
                    // $('#div-search').slideUp(); // Ocultar el div-search
                    $('#div-search').hide();
                    // Habilitar la edición de los campos del formulario
                    $('#datos-estudiante input, #datos-estudiante select, #datos-estudiante textarea').prop(
                        'readonly', false);
                    $('#datos-estudiante input[type="file"]').prop('disabled', false); // Permitir cargar foto
                    $('#gender').prop('disabled', false);
                    $('#divPassword').show()
                    $('#foto').val('');
                    $('#foto').show();
                }
            }

            // Evento al hacer clic fuera del input de búsqueda para cerrar los resultados
            $(document).on('click', function(event) {
                if (!$(event.target).closest('#search').length && !$(event.target).closest('#divSearch')
                    .length) {
                    $('#searchList').hide();
                }
            });
            $('#formEstudiante').on('submit', function(event) {
                console.log("ANTES DE ENVIAR EL FORMULARIO");
                // Evitar el envío predeterminado del formulario
                event.preventDefault();
                console.log("antes del if");
                if (validarFormulario()) {
                    console.log("ingresa al if");
                    this.submit();
                }
                console.log("no ingresa al if")
            });
            $('#search').on('input', function() {
                var query = $(this).val().trim();
                var apiUrl = new URL('/api/search-estudiante', window.location.origin);

                colaboradores = [];
                $.ajax({
                    url: apiUrl.toString(),
                    type: "GET",
                    data: {
                        'query': query
                    },
                    success: function(data) {
                        var html = '';
                        console.log(data);
                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                colaboradores.push(value);
                                html += `
                                    <div class="colaborador cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100"
                                        id="${value.id}">
                                        <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                                            <div class="w-6 flex flex-col items-center ml-2">
                                                <div class="flex relative w-8 h-8 bg-orange-500 justify-center items-center m-1 mr-2 mt-1 rounded-full">
                                                    <img class="rounded-full w-full h-full object-cover" alt="Avatar" src="${value.user.image}">
                                                </div>
                                            </div>
                                            <div class="w-full items-center flex ml-2">
                                                <div class="mx-2 -mt-1">
                                                    ${value.user.name} ${value.user.lastname}
                                                    <div class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500">
                                                        ${value.user.email}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                            });
                            console.log("estudiantes: ", colaboradores);
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

            function buscarById(id) {
                let estudiante = null;

                for (let i = 0; i < colaboradores.length; i++) {
                    if (colaboradores[i].id === parseInt(id)) {
                        estudiante = colaboradores[i];
                        return estudiante;
                    }
                }
                return estudiante;
            }
            // Evento para añadir colaborador al hacer clic en un resultado de búsqueda
            $(document).on('click', '.colaborador', function() {
                const id = $(this).attr('id');
                const estudiante = buscarById(id); //colaboradores.filter(elemento => elemento.id === id);
                console.log("estudiante: ", estudiante);
                $('#estudiante_id').val(estudiante.user.id);
                $('#ci').val(estudiante.user.ci);
                $('#name').val(estudiante.user.name);
                $('#lastname').val(estudiante.user.lastname);
                $('#gender').val(estudiante.user.gender);
                $('#birth_date').val(estudiante.user.birth_date);
                $('#address').val(estudiante.user.address);
                $('#puntuacion').val(estudiante.puntuacion);
                $('#nivel').val(estudiante.nivel_id);
                $('#email').val(estudiante.user.email);
                $('#div-sin-foto').html('<img src="' + estudiante.user.image +
                    '" class="w-12 h-12 rounded-full object-cover border border-gray-400" alt="Foto de perfil"/>'
                );
                $('#divPassword').hide();
                $('#searchList').hide();
            });
            // CAMBIAR FOTO CARGADA
            $('#foto').on('change', function(event) {
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#div-sin-foto').html('<img src="' + e.target.result +
                            '" class="w-12 h-12 rounded-full object-cover border border-gray-400" alt="Foto de perfil"/>'
                        );
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
            //CAMBIAR RADIO
            // Al cargar el documento, verificar el radio seleccionado inicialmente
            checkRadioSelection();

            // Agregar un listener para detectar cambios en los radios
            $('input[name="radioEstudiante"]').change(function() {
                checkRadioSelection();
            });


            //AGREGAR BUTTON CARGANDO
            $('#btnAgregar').on('click', function() {
                var $btnAgregar = $(this);
                var $btnProcessingText = $('#btnProcessingText');

                // Deshabilitar el botón de agregar y mostrar el botón de procesamiento
                $btnAgregar.attr('disabled', 'disabled');
                $btnProcessingText.show();

                // Aquí puedes realizar cualquier otra lógica o enviar una petición AJAX, etc.

                // Ejemplo de simulación de tiempo de carga
                setTimeout(function() {
                    // Simular que la operación ha terminado y restablecer el botón de agregar
                    $btnAgregar.removeAttr('disabled');
                    $btnProcessingText.hide();
                }, 3000); // Tiempo de simulación de 3 segundos
            });
        });
    </script>
</x-app-layout>
