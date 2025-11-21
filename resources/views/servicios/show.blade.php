<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Información del Servicio</h3>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nombre:</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $servicio->nombre }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Precio:</label>
                                <p class="mt-1 text-sm text-gray-900">${{ number_format($servicio->precio, 2) }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Registro:</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $servicio->created_at->format('d/m/Y H:i') }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Última Actualización:</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $servicio->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                     <a href="{{ route('servicios.edit', $servicio->id) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                    Editar
                    </a>
                    <a href="{{ route('servicios.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Volver
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>