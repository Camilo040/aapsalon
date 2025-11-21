<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Servicio;
use App\Models\Cita;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class ChartController extends Controller
{
    public function index()
    {
        /* === Usuarios por mes (últimos 6 meses) === */
        $usuariosMes = User::select(
            DB::raw('COUNT(*) as total'),
            DB::raw('MONTH(created_at) as mes')
        )
        ->where('created_at', '>=', Carbon::now()->subMonths(6))
        ->groupBy('mes')
        ->orderBy('mes')
        ->get();

        $labelsUsuarios = $usuariosMes->pluck('mes')->map(function($m){
            return Carbon::create()->month($m)->translatedFormat('F');
        });

        $dataUsuarios = $usuariosMes->pluck('total');


        /* === Distribución de roles === */
        $roles = User::select('role', DB::raw('COUNT(*) as total'))
            ->groupBy('role')
            ->get();

        $rolesLabels = $roles->pluck('role');
        $rolesData   = $roles->pluck('total');


        /* === Total servicios === */
        $totalServicios = Servicio::count();


        /* === Citas por día (últimos 7 días) === */
        $citasDias = Cita::select(
            DB::raw('COUNT(*) as total'),
            DB::raw('DATE(fecha) as fecha')
        )
        ->where('fecha', '>=', Carbon::now()->subDays(7))
        ->groupBy('fecha')
        ->get();

        $labelsCitas = $citasDias->pluck('fecha');
        $dataCitas   = $citasDias->pluck('total');


        return view('dashboard.charts', compact(
            'labelsUsuarios', 'dataUsuarios',
            'rolesLabels', 'rolesData',
            'totalServicios',
            'labelsCitas', 'dataCitas'
        ));
    }
}