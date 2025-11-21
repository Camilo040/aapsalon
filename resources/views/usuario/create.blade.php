<x-app-layout>
 <x-slot name="header">
 <h2 class="font-semibold text-xl text-gray-800 leading-tight">
 {{ __('Crear Usuario') }}
 </h2>
 </x-slot>
 <div class="py-12">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
 <div class="p-6 text-gray-900">
 @if ($errors->any())
 <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
 <ul>
 @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
 @endif
 <form method="POST" action="{{ route('usuario.store') }}">
 @csrf

 <div class="mb-4">
 <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
 <input type="text" name="name" id="name"
 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
 value="{{ old('name') }}" required>
 </div>
 <div class="mb-4">
 <label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
 <input type="email" name="email" id="email"
 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
 value="{{ old('email') }}" required>
 </div>
 <div class="mb-4">
 <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
 <input type="password" name="password" id="password"
 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
 required>
 </div>
                    <div class="flex justify-end">
                        <a href="{{ route('usuario.index') }}"
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