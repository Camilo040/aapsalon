<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📊 Dashboard de Gráficas
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Usuarios registrados por mes -->
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-semibold mb-3">Usuarios registrados (últimos 6 meses)</h3>
                <canvas id="usuariosMes"></canvas>
            </div>

            <!-- Distribución de roles -->
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-semibold mb-3">Distribución de Roles</h3>
                <canvas id="rolesChart"></canvas>
            </div>

            <!-- Total servicios -->
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-semibold mb-3">Total de Servicios Registrados</h3>
                <h1 class="text-5xl font-bold text-indigo-600">{{ $totalServicios }}</h1>
            </div>

            <!-- Citas últimos 7 días -->
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-semibold mb-3">Citas (últimos 7 días)</h3>
                <canvas id="citasChart"></canvas>
            </div>

        </div>
    </div>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        /* Gráfica Usuarios por Mes */
        new Chart(document.getElementById('usuariosMes'), {
            type: 'bar',
            data: {
                labels: @json($labelsUsuarios),
                datasets: [{
                    label: 'Usuarios registrados',
                    data: @json($dataUsuarios),
                    backgroundColor: 'rgba(59, 130, 246, 0.6)'
                }]
            }
        });

        /* Roles */
        new Chart(document.getElementById('rolesChart'), {
            type: 'pie',
            data: {
                labels: @json($rolesLabels),
                datasets: [{
                    label: 'Roles',
                    data: @json($rolesData),
                    backgroundColor: ['#10B981', '#F59E0B', '#EF4444']
                }]
            }
        });

        /* Citas últimos 7 días */
        new Chart(document.getElementById('citasChart'), {
            type: 'line',
            data: {
                labels: @json($labelsCitas),
                datasets: [{
                    label: 'Citas por día',
                    data: @json($dataCitas),
                    borderColor: 'rgba(139, 92, 246, 0.8)',
                    tension: 0.3
                }]
            }
        });
    </script>

</x-app-layout>