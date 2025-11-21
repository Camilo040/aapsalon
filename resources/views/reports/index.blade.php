<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Centro de Reportes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Estadísticas Rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <!-- Total Usuarios -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Usuarios</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $totalUsuarios }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Servicios -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4V11M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Servicios</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $totalServicios }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Citas -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10m-12 8h14a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Citas</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $totalCitas }}</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Reportes PDF -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">📄 Reportes PDF</h3>

                    <div class="space-y-4">

                        <!-- Reporte Usuarios -->
                        <div class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-semibold text-gray-800">Reporte de Usuarios</h4>
                                    <p class="text-sm text-gray-600">Lista completa de usuarios registrados</p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('reports.usuarios.pdf') }}"
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                                        Descargar PDF
                                    </a>
                                    <a href="{{ route('reports.usuarios.preview') }}" target="_blank"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                                        Vista Previa
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Reporte Servicios -->
                        <div class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-semibold text-gray-800">Reporte de Servicios</h4>
                                    <p class="text-sm text-gray-600">Listado de todos los servicios registrados</p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('reports.servicios.pdf') }}"
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                                        Descargar PDF
                                    </a>
                                    <a href="{{ route('reports.servicios.preview') }}" target="_blank"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                                        Vista Previa
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Reporte Citas -->
                        <div class="border rounded-lg p-4 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-semibold text-gray-800">Reporte de Citas</h4>
                                    <p class="text-sm text-gray-600">Listado de citas programadas</p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('reports.citas.pdf') }}"
                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                                        Descargar PDF
                                    </a>
                                    <a href="{{ route('reports.citas.preview') }}" target="_blank"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                                        Vista Previa
                                    </a>
                                </div>
                            </div>
                        </div>
<!-- Sección de Exportación Excel/CSV -->
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">📊Exportación a Excel/CSV</h3>

        <div class="space-y-4">

            {{-- Exportar Usuarios --}}
            <div class="border rounded-lg p-4 hover:bg-gray-50">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-semibold text-gray-800">Exportar Usuarios</h4>
                        <p class="text-sm text-gray-600">Descargar lista completa de usuarios</p>
                    </div>

                    <div class="space-x-2">
                        <a href="{{ route('export.usuarios.excel') }}"
                           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                            Excel
                        </a>

                        <a href="{{ route('export.usuarios.csv') }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded text-sm">
                            CSV
                        </a>
                    </div>
                </div>
            </div>

            {{-- Exportar Servicios --}}
            <div class="border rounded-lg p-4 hover:bg-gray-50">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-semibold text-gray-800">Exportar Servicios</h4>
                        <p class="text-sm text-gray-600">Descargar lista de servicios registrados</p>
                    </div>

                    <div class="space-x-2">
                        <a href="{{ route('export.servicios.excel') }}"
                           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                            Excel
                        </a>

                        <a href="{{ route('export.servicios.csv') }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded text-sm">
                            CSV
                        </a>
                    </div>
                </div>
            </div>

            {{-- Exportar Citas --}}
            <div class="border rounded-lg p-4 hover:bg-gray-50">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-semibold text-gray-800">Exportar Citas</h4>
                        <p class="text-sm text-gray-600">Descargar todas las citas registradas</p>
                    </div>

                    <div class="space-x-2">
                        <a href="{{ route('export.citas.excel') }}"
                           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                            Excel
                        </a>

                        <a href="{{ route('export.citas.csv') }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded text-sm">
                            CSV
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>