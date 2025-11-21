<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Servicio;
use App\Models\Cita;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class ExportController extends Controller
{
    /* ============================================
       ============ EXPORTAR USUARIOS =============
       ============================================ */

    public function exportUsuariosExcel()
    {
        $usuarios = User::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Encabezados
        $sheet->fromArray(
            [['ID', 'Nombre', 'Email', 'Fecha Registro']],
            null,
            'A1'
        );

        $row = 2;
        foreach ($usuarios as $u) {
            $sheet->fromArray([
                $u->id,
                $u->name,
                $u->email,
                $u->created_at,
            ], null, "A{$row}");
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        return response()->streamDownload(fn() => $writer->save('php://output'), 'usuarios.xlsx');
    }

    public function exportUsuariosCSV()
    {
        $usuarios = User::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray(
            [['ID', 'Nombre', 'Email', 'Fecha Registro']],
            null,
            'A1'
        );

        $row = 2;
        foreach ($usuarios as $u) {
            $sheet->fromArray([
                $u->id,
                $u->name,
                $u->email,
                $u->created_at,
            ], null, "A{$row}");
            $row++;
        }

        $writer = new Csv($spreadsheet);
        return response()->streamDownload(fn() => $writer->save('php://output'), 'usuarios.csv');
    }


    /* ============================================
       ============ EXPORTAR SERVICIOS ============
       ============================================ */

    public function exportServiciosExcel()
    {
        $servicios = Servicio::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray(
            [['ID', 'Nombre', 'Precio', 'Fecha Registro']],
            null,
            'A1'
        );

        $row = 2;
        foreach ($servicios as $s) {
            $sheet->fromArray([
                $s->id,
                $s->nombre,
                $s->precio,
                $s->created_at,
            ], null, "A{$row}");
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        return response()->streamDownload(fn() => $writer->save('php://output'), 'servicios.xlsx');
    }

    public function exportServiciosCSV()
    {
        $servicios = Servicio::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray(
            [['ID', 'Nombre', 'Precio', 'Fecha Registro']],
            null,
            'A1'
        );

        $row = 2;
        foreach ($servicios as $s) {
            $sheet->fromArray([
                $s->id,
                $s->nombre,
                $s->precio,
                $s->created_at,
            ], null, "A{$row}");
            $row++;
        }

        $writer = new Csv($spreadsheet);
        return response()->streamDownload(fn() => $writer->save('php://output'), 'servicios.csv');
    }


    /* ============================================
       ============= EXPORTAR CITAS ===============
       ============================================ */

    public function exportCitasExcel()
    {
        $citas = Cita::with('usuario')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray(
            [['ID', 'Fecha', 'Hora', 'Usuario', 'Fecha Registro']],
            null,
            'A1'
        );

        $row = 2;
        foreach ($citas as $c) {
            $sheet->fromArray([
                $c->id,
                $c->fecha,
                $c->hora,
                $c->usuario ? $c->usuario->name : 'Sin usuario',
                $c->created_at,
            ], null, "A{$row}");
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        return response()->streamDownload(fn() => $writer->save('php://output'), 'citas.xlsx');
    }

    public function exportCitasCSV()
    {
        $citas = Cita::with('usuario')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray(
            [['ID', 'Fecha', 'Hora', 'Usuario', 'Fecha Registro']],
            null,
            'A1'
        );

        $row = 2;
        foreach ($citas as $c) {
            $sheet->fromArray([
                $c->id,
                $c->fecha,
                $c->hora,
                $c->usuario ? $c->usuario->name : 'Sin usuario',
                $c->created_at,
            ], null, "A{$row}");
            $row++;
        }

        $writer = new Csv($spreadsheet);
        return response()->streamDownload(fn() => $writer->save('php://output'), 'citas.csv');
    }
}