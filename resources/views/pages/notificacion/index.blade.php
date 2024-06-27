<x-app-layout>
    <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Todas las notificaciones</h2>

        <ul class="divide-y divide-gray-200">
            @forelse ($notifications as $notification)
                {{-- <div class="flex justify-between py-6 px-4 bg-white/30 rounded-lg">
                    <div class="flex items-center space-x-4">
                        <img src="{{ $notification->data['image'] }}" class="rounded-full h-14 w-14" alt="">
                        <div class="flex flex-col space-y-1">
                            <span class="font-bold">{{ $notification->data['title'] }}</span>
                            <span class="text-sm">{{ $notification->data['content'] }}</span>
                        </div>
                    </div>
                    <div class="flex-none px-4 py-2 text-stone-600 text-xs md:text-sm">
                        {{ $notification->created_at->formatLocalized('%d %B %Y') }}
                        {{ $notification->created_at->formatLocalized('%H:%M:%S') }}
                    </div>
                </div> --}}
                <div class="flex flex-col px-4 py-2 mb-2 bg-white shadow-md hover:shadow-lg rounded-2xl">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="{{ $notification->data['image'] }}" class="rounded-full h-12 w-12" alt="">
                            <div class="flex flex-col ml-3">
                                <div class="font-medium leading-none">{{ $notification->data['title'] }}</div>
                                <p class="text-sm text-gray-800 leading-none mt-1">{{ $notification->data['content'] }}</p>
                            </div>
                        </div>
                        <div class="flex-none py-2 text-stone-800 text-xs md:text-sm">
                            <div class="text-right">
                                {{ $notification->created_at->formatLocalized('%d %B %Y') }} {{-- Formato personalizado para día, mes y año --}}
                                {{ $notification->created_at->formatLocalized('%H:%M:%S') }} {{-- Formato personalizado para hora, minutos y segundos --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <li class="py-4">
                    <div class="text-sm text-gray-900">{!! $notification->data['content'] !!}</div>
                    <div class="text-xs text-gray-500">
                        {{ $notification->created_at->formatLocalized('%d %B %Y') }} 
                        {{ $notification->created_at->formatLocalized('%H:%M:%S') }}
                    </div>
                </li> --}}
            @empty
                <li class="py-4 text-sm text-gray-500">No tienes notificaciones.</li>
            @endforelse
        </ul>

        <!-- Paginación si lo deseas -->
        {{ $notifications->links() }}
    </div>
</x-app-layout>
