<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl">
        @php
            $titulo=''.$grupo->nombre;
        @endphp
        <x-breadcrumbs :breadcrumbs="[
            ['nombre' => 'Lista de grupos', 'href' => route('admin.grupo.index')],
            ['nombre' => $titulo, 'href' => route('admin.grupo.show',$grupo->id)],
            ['nombre' => 'Chat', 'href' => route('admin.grupo.chat',$grupo->id)],
        ]" />
        <div class="flex-1 flex flex-col min-h-screen">
            {{-- <header class="bg-white p-4 text-gray-700">
                <h1 class="text-2xl font-semibold">Chat del grupo {{ $grupo->nombre }}</h1>
            </header> --}}

            <div class="flex-1 overflow-y-auto p-4" id="chat-messages">
                @if ($mensajes->isEmpty())
                    <p class="text-center text-gray-600 p-4">Sin mensajes anteriores.</p>
                @else
                    @foreach ($mensajes as $mensaje)
                        @if ($mensaje->user->id == Auth::user()->id)
                            <div class="flex justify-end mb-4 cursor-pointer">
                                <div class="flex max-w-96 bg-indigo-500 text-white rounded-lg p-3 gap-3">
                                    <p>{{ $mensaje->txt }}</p>
                                </div>
                                <div class="w-9 h-9 rounded-full flex items-center justify-center ml-2">
                                    <img src="{{ $mensaje->user->image }}" alt="My Avatar" class="w-8 h-8 rounded-full">
                                </div>
                            </div>
                        @else
                            <div class="flex mb-4 cursor-pointer">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center mr-2">
                                    <img src="{{ $mensaje->user->image }}" alt="User Avatar"
                                        class="w-8 h-8 rounded-full">
                                </div>
                                <div class="flex max-w-96 bg-white rounded-lg p-3 gap-3">
                                    <p class="text-gray-700">{{ $mensaje->txt }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

            <footer class="bg-white border-t border-gray-300 p-4 fixed bottom-0 w-3/4">
                <div class="flex items-center">
                    <input type="text" id="message-input" placeholder="Type a message..." data-grupo="{{ $grupo->id }}" data-user="{{ auth()->id() }}"
                        class="w-full p-2 rounded-md border border-gray-400 focus:outline-none focus:border-blue-500">
                    <button id="send-button" class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2">Enviar</button>
                </div>
            </footer>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#send-button').click(function(e) {
                e.preventDefault();
                var message = $('#message-input').val();
                var grupoId = $('#message-input').data('grupo');
                var userId = $('#message-input').data('user');
                if (message.trim() === '' || grupoId === '' || userId === '') {
                    console.error('Message, group ID or user ID is empty');
                    return;
                }

                $.ajax({
                    url: '{{ route('api.send-message', $grupo->id) }}',
                    method: 'POST',
                    data: {
                        user_id: userId,
                        txt: message
                    },
                    success: function(response) {
                        $('#message-input').val('');
                        var newMessage = '<div class="flex justify-end mb-4 cursor-pointer">' +
                            '<div class="flex max-w-96 bg-indigo-500 text-white rounded-lg p-3 gap-3">' +
                            '<p>' + response.txt + '</p>' +
                            '</div>' +
                            '<div class="w-9 h-9 rounded-full flex items-center justify-center ml-2">' +
                            '<img src="' + response.user.image +
                            '" alt="My Avatar" class="w-8 h-8 rounded-full">' +
                            '</div>' +
                            '</div>';
                        $('#chat-messages').append(newMessage);
                        $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
</x-app-layout>
