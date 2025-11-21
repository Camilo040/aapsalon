<x-app-layout>
 <x-slot name="header">
 <h2 class="font-semibold text-xl text-gray-800 leading-tight">
 {{ __('Gestión de Usuarios') }}
 </h2>
 </x-slot>
 <div class="py-12">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
 <div class="p-6 text-gray-900">
 @if(session('success'))
 <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
 {{ session('success') }}
 </div>
 @endif
 {{-- BOTÓN NUEVO USUARIO --}}
                    <div class="mb-4">
                        <a href="{{ route('usuario.create') }}"
                           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                            + Nuevo Usuario
                        </a>
                    </div>
 </a>
 </div>
 <table class="min-w-full table-auto">
 <thead>
 <tr class="bg-gray-50">
 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
 </tr>
 </thead>
 <tbody class="bg-white divide-y divide-gray-200">
 @foreach ($users as $user)
 <tr>
 <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
 <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
 <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
 <a href="{{ route('usuario.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
 <a href="{{ route('usuario.show', $user->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Ver</a>
 <form class="inline-block" method="POST" action="{{ route('usuario.destroy', $user->id) }}">
 @csrf
 @method('DELETE')
 <button type="submit" class="text-red-600 hover:text-red-900"
 onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
 Eliminar
 </button>
 </form>
 </td>
 </tr>
 @endforeach
 </tbody>
 </table>
 </div>
 </div>
 </div>
 </div>
</x-app-layout>