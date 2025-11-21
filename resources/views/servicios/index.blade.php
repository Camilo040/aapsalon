<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Servicios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Mensaje de éxito --}}
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- BOTÓN NUEVO SERVICIO --}}
                    <div class="mb-4">
                        <a href="{{ route('servicios.create') }}"
                           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                            + Nuevo Servicio
                        </a>
                    </div>

                    {{-- TABLA DE SERVICIOS --}}
                    <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Nombre</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Precio</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($servicios as $servicio)
                                <tr>
                                    <td class="px-6 py-4">{{ $servicio->nombre }}</td>
                                    <td class="px-6 py-4">${{ number_format($servicio->precio, 2) }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <a href="{{ route('servicios.edit', $servicio->id) }}"
                                           class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                                        <form action="{{ route('servicios.destroy', $servicio->id) }}" method="POST" class="inline-block">
                                            <a href="{{ route('servicios.show', $servicio->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Ver</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                    onclick="return confirm('¿Seguro que deseas eliminar este servicio?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                        No hay servicios registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>