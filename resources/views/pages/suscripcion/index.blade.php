<x-app-layout>
    <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="mb-3">
            <x-breadcrumbs :breadcrumbs="[['nombre' => 'Mis suscripciones', 'href' => route('admin.suscripcion.index')]]" />
            <x-link-button href="{{ route('admin.suscripcion.renovar') }}">
                Renovar suscripción
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
                                Nombre
                            </th>
                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Costo
                            </th>
                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Fecha Inicio
                            </th>
                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Fecha Fin
                            </th>
                            <th scope="col"
                                class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Estado
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                        @foreach ($suscripciones as $suscripcion)
                            <tr id="{{ $suscripcion->id }}">
                                <td
                                    class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                    {{ $suscripcion->id }}</td>
                                <td class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                    {{ $suscripcion->costo_total }}</td>
                                <td class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                    {{ $suscripcion->plan->titulo }}</td>
                                <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300 whitespace-nowrap">
                                    {{ $suscripcion->fecha_registro }}
                                </td>
                                <td class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                    {{ $suscripcion->fecha_finalizacion }}</td>
                                <td class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                    @if ($suscripcion->estado)
                                        @if (Carbon\Carbon::now()->lte(Carbon\Carbon::parse($suscripcion->fecha_finalizacion)))
                                            <div class="text-green-600">Vigente</div>
                                        @else
                                            <div class="text-red-600">Expirado</div>
                                        @endif
                                    @else
                                        <div class="text-red-600">Expirado</div>
                                    @endif
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    {{-- CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    {{-- JS --}}
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

</x-app-layout>
