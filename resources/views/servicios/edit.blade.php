<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Mostrar errores --}}
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Formulario para editar --}}
                    <form method="POST" action="{{ route('servicios.update', $servicio->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Servicio</label>
                            <input type="text" name="nombre" id="nombre"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   value="{{ old('nombre', $servicio->nombre) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                            <input type="number" name="precio" id="precio" step="0.01"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   value="{{ old('precio', $servicio->precio) }}" required>
                        </div>

                    <div class="flex justify-end">
                        <a href="{{ route('servicios.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">Cancelar</a>
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>