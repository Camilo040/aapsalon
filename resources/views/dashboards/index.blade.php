<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard de Estadísticas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Resumen General</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
                        <p class="text-sm">Usuarios Registrados</p>
                        <p class="text-3xl font-bold">{{ $totalUsuarios }}</p>
                    </div>

                    <div class="bg-green-500 text-white p-6 rounded-lg shadow">
                        <p class="text-sm">Servicios Disponibles</p>
                        <p class="text-3xl font-bold">{{ $totalServicios }}</p>
                    </div>

                    <div class="bg-purple-600 text-white p-6 rounded-lg shadow">
                        <p class="text-sm">Citas Registradas</p>
                        <p class="text-3xl font-bold">{{ $totalCitas }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-bold mb-4">Usuarios Registrados por Mes</h3>
                <canvas id="usuariosChart"></canvas>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mt-6">
                <h3 class="text-xl font-bold mb-4">Citas Registradas por Mes</h3>
                <canvas id="citasChart"></canvas>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const usuariosData = @json(array_values($usuariosPorMes));
        const usuariosLabels = @json(array_keys($usuariosPorMes));

        const citasData = @json(array_values($citasPorMes));
        const citasLabels = @json(array_keys($citasPorMes));

        new Chart(document.getElementById('usuariosChart'), {
            type: 'line',
            data: {
                labels: usuariosLabels,
                datasets: [{
                    label: 'Usuarios por Mes',
                    data: usuariosData,
                    borderWidth: 2,
                    tension: 0.3
                }]
            }
        });

        new Chart(document.getElementById('citasChart'), {
            type: 'bar',
            data: {
                labels: citasLabels,
                datasets: [{
                    label: 'Citas por Mes',
                    data: citasData,
                    borderWidth: 2
                }]
            }
        });
    </script>

</x-app-layout>