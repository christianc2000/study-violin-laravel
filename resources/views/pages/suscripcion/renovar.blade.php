<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl">
        <div class="mb-3">
            <x-breadcrumbs :breadcrumbs="[
                ['nombre' => 'Mis suscripciones', 'href' => route('admin.suscripcion.index')],
                ['nombre' => 'Renovar suscripcion', 'href' => route('admin.suscripcion.renovar')],
            ]" />
            <form id="formEstudiante" action="{{ route('admin.suscripcion.store') }}" id="formSuscripcion" method="POST"
                onsubmit="return validarFormulario()">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="mb-3" id="divSelect">
                        <label for="plan_id" class="form-label text-sm font-medium text-gray-800">Planes</label>
                        <x-select id="plan_id" name="plan_id">
                            <option value="">Seleccione una opción</option>
                            @foreach ($planes as $plan)
                                <option value="{{ $plan->id }}" data-meses="{{ $plan->mes }}">{{ $plan->titulo }}
                                </option>
                            @endforeach
                        </x-select>
                        <span id="planIdError" class="text-sm font-medium text-red-500"></span>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_registro" class="form-label text-sm font-medium text-gray-800">Fecha
                            inicio</label>
                        @php
                            $fechaInicio = Carbon\Carbon::now()->format('Y-m-d');

                            $suscripcionActiva = Auth::user()->suscripcions()->where('estado', true)->latest()->first();

                            if ($suscripcionActiva) {
                                $fechaInicio = $suscripcionActiva->fecha_finalizacion;
                            }

                        @endphp
                        <x-input type="date" id="fecha_registro" name="fecha_registro" min="{{ $fechaInicio }}"
                            value="{{ $fechaInicio }}" required />
                        <span id="fechaRegistroError" class="text-sm font-medium text-red-500"></span>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_finalizacion" class="form-label text-sm font-medium text-gray-800">Fecha
                            Finalización</label>
                        <x-input type="date" id="fecha_finalizacion" name="fecha_finalizacion" disabled />
                        <span id="fechaFinalizacionError" class="text-sm font-medium text-red-500"></span>
                    </div>
                </div>
                <div class="col-span-full md:col-span-1 flex justify-end">
                    <x-button type="submit" class="mt-4">
                        <i class="ti ti-plus"></i> Guardar
                    </x-button>
                </div>
            </form>
        </div>
    </div>
    {{-- JS --}}
    <script>
        function validarFormulario() {
            var planSeleccionado = $('#plan_id').val();
            if (!planSeleccionado) {
                $('#planIdError').text('Seleccione un plan válido.');
                return false;
            } else {
                $('#planIdError').text('');
            }

            var fechaRegistro = new Date($('#fecha_registro').val());
            var fechaFinalizacion = new Date($('#fecha_finalizacion').val());

            if (fechaRegistro > fechaFinalizacion) {
                $('#fechaFinalizacionError').text(
                    'La fecha de finalización debe ser posterior o igual a la fecha de inicio.');
                return false;
            } else {
                $('#fechaFinalizacionError').text('');
            }

            return true;
        }

        $(document).ready(function() {
            $('#plan_id').change(function() {
                var selectedPlan = $(this).children('option:selected');
                var meses = selectedPlan.data('meses');
                if (meses) {
                    var fechaInicio = new Date($('#fecha_registro').val());
                    var fechaFinalizacion = new Date(fechaInicio.getFullYear(), fechaInicio.getMonth() +
                        meses, fechaInicio.getDate());
                    var formattedDate = fechaFinalizacion.toISOString().slice(0, 10);
                    $('#fecha_finalizacion').val(formattedDate);
                    $('#fecha_finalizacion').prop('disabled', false);
                }
            });
        });
    </script>
</x-app-layout>
