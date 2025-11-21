<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

 {{-- BOTÓN NUEVO USUARIO --}}
                    <div class="mb-4">
                        <a href="{{ route('citas.create') }}"
                           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                            + Nueva Cita
                        </a>
                    </div>
                    </div>

                    @if ($citas->isEmpty())
                        <p class="text-gray-600">No hay citas registradas.</p>
                    @else
                        <table class="min-w-full border-collapse border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border border-gray-200 px-4 py-2 text-left">ID</th>
                                    <th class="border border-gray-200 px-4 py-2 text-left">Fecha</th>
                                    <th class="border border-gray-200 px-4 py-2 text-left">Hora</th>
                                    <th class="border border-gray-200 px-4 py-2 text-left">Usuario</th>
                                    <th class="border border-gray-200 px-4 py-2 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($citas as $cita)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-200 px-4 py-2">{{ $cita->id }}</td>
                                        <td class="border border-gray-200 px-4 py-2">{{ $cita->fecha }}</td>
                                        <td class="border border-gray-200 px-4 py-2">{{ $cita->hora }}</td>
                                        <td class="border border-gray-200 px-4 py-2">{{ $cita->usuarioId ?? 'Sin usuario' }}</td>
                                        <td class="border border-gray-200 px-4 py-2 text-center space-x-2">
                                            <a href="{{ route('citas.edit', $cita->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
 <a href="{{ route('citas.show', $cita->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Ver</a>
 <form class="inline-block" method="POST" action="{{ route('citas.destroy', $cita->id) }}">
 @csrf
 @method('DELETE')
 <button type="submit" class="text-red-600 hover:text-red-900"
 onclick="return confirm('¿Estás seguro de eliminar esta cita?')">
 Eliminar
 </button>
 </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>