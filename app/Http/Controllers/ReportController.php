<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Servicio;
use App\Models\Cita;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Página principal de reportes
     */
    public function index()
    {
        $totalUsuarios  = User::count();
        $totalServicios = Servicio::count();
        $totalCitas     = Cita::count();

        $usuariosRecientes = User::latest()->take(5)->get();

        return view('reports.index', compact(
            'totalUsuarios',
            'totalServicios',
            'totalCitas',
            'usuariosRecientes'
        ));
    }

    // ============================================================
    // REPORTE USUARIOS
    // ============================================================

    public function usuariosPDF()
    {
        $usuarios = User::orderBy('name')->get();

        $data = [
            'titulo'      => 'Reporte de Usuarios',
            'fecha'       => Carbon::now()->format('d/m/Y H:i:s'),
            'usuarios'    => $usuarios,
            'total'       => $usuarios->count(),
            'filtro_role' => 'N/A'
        ];

        $pdf = Pdf::loadView('reports.usuarios-pdf', $data);
        $pdf->setPaper('letter', 'portrait');

        return $pdf->download('reporte-usuarios-' . date('Y-m-d') . '.pdf');
    }

    public function usuariosPreview()
    {
        $usuarios = User::orderBy('name')->get();

        $data = [
            'titulo'      => 'Reporte de Usuarios',
            'fecha'       => Carbon::now()->format('d/m/Y H:i:s'),
            'usuarios'    => $usuarios,
            'total'       => $usuarios->count(),
            'filtro_role' => 'N/A'
        ];

        $pdf = Pdf::loadView('reports.usuarios-pdf', $data);
        return $pdf->stream('reporte-usuarios.pdf');
    }

    // ============================================================
    // REPORTE SERVICIOS
    // ============================================================

    public function serviciosPDF()
    {
        $servicios = Servicio::orderBy('nombre')->get();

        $data = [
            'titulo'    => 'Reporte de Servicios',
            'fecha'     => Carbon::now()->format('d/m/Y H:i:s'),
            'servicios' => $servicios,
            'total'     => $servicios->count(),
        ];

        $pdf = Pdf::loadView('reports.servicios-pdf', $data);
        $pdf->setPaper('letter', 'portrait');

        return $pdf->download('reporte-servicios-' . date('Y-m-d') . '.pdf');
    }

    public function serviciosPreview()
    {
        $servicios = Servicio::orderBy('nombre')->get();

        $data = [
            'titulo'    => 'Reporte de Servicios',
            'fecha'     => Carbon::now()->format('d/m/Y H:i:s'),
            'servicios' => $servicios,
            'total'     => $servicios->count(),
        ];

        $pdf = Pdf::loadView('reports.servicios-pdf', $data);
        return $pdf->stream('reporte-servicios.pdf');
    }

    // ============================================================
    // REPORTE CITAS
    // ============================================================

    public function citasPDF()
    {
        $citas = Cita::with('user')->orderBy('fecha')->get();

        $data = [
            'titulo' => 'Reporte de Citas',
            'fecha'  => Carbon::now()->format('d/m/Y H:i:s'),
            'citas'  => $citas,
            'total'  => $citas->count(),
        ];

        $pdf = Pdf::loadView('reports.citas-pdf', $data);
        $pdf->setPaper('letter', 'portrait');

        return $pdf->download('reporte-citas-' . date('Y-m-d') . '.pdf');
    }

    public function citasPreview()
    {
        $citas = Cita::with('user')->orderBy('fecha')->get();

        $data = [
            'titulo' => 'Reporte de Citas',
            'fecha'  => Carbon::now()->format('d/m/Y H:i:s'),
            'citas'  => $citas,
            'total'  => $citas->count(),
        ];

        $pdf = Pdf::loadView('reports.citas-pdf', $data);
        return $pdf->stream('reporte-citas.pdf');
    }
}