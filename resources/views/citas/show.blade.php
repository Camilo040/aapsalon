<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de la Cita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Información de la Cita</h3>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha:</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $cita->fecha }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Hora:</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $cita->hora }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Usuario:</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $cita->usuarioId ?? 'No asignado' }}
                                </p>
                            </div>
                        </div>
                    </div>
 <div class="flex items-center space-x-3">
 <a href="{{ route('citas.edit', $cita->id) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
 Editar
 </a>
 <a href="{{ route('citas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
 Volver
 </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>