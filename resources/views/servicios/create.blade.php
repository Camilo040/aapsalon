<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">

                {{-- Errores de validación --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc ml-6">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('servicios.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre del servicio:</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                               class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-200" required>
                    </div>

                    <div class="mb-4">
                        <label for="precio" class="block text-gray-700 font-bold mb-2">Precio:</label>
                        <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio') }}"
                               class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-200" required>
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
</x-app-layout>