<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>{{ $titulo }}</title>
 <style>
 body {
 font-family: Arial, sans-serif;
 margin: 0;
 padding: 20px;
 font-size: 12px;
 }
 .header {
 text-align: center;
 margin-bottom: 30px;
 border-bottom: 3px solid #4F46E5;
 padding-bottom: 20px;
 }
 .header h1 {
 color: #4F46E5;
 margin: 0;
 font-size: 24px;
 }
 .header .subtitle {
 color: #666;
 margin-top: 5px;
 font-size: 11px;
 }
 .info-box {
 background: #F3F4F6;
 padding: 15px;
 border-radius: 5px;
 margin-bottom: 20px;
 }
 .info-box table {
 width: 100%;
 }
 .info-box td {
 padding: 5px;
 }
 .info-box .label {
 font-weight: bold;
 color: #374151;
 width: 30%;
 }
 table.data {
 width: 100%;
 border-collapse: collapse;
 margin-top: 20px;
 }
 table.data th {
 background: #4F46E5;
 color: white;
 padding: 12px 8px;
 text-align: left;
 font-size: 11px;
 font-weight: bold;
 }
 table.data td {
 padding: 10px 8px;
 border-bottom: 1px solid #E5E7EB;
 }
 table.data tr:nth-child(even) {
 background: #F9FAFB;
 }
 .badge {
 display: inline-block;
 padding: 3px 8px;
 border-radius: 3px;
 font-size: 10px;
 font-weight: bold;
 }
 .badge-admin { background: #DC2626; color: white; }
 .badge-editor { background: #F59E0B; color: white; }
 .badge-usuario { background: #10B981; color: white; }
 .footer {
 margin-top: 30px;
 text-align: center;
 color: #6B7280;
 font-size: 10px;
 border-top: 1px solid #E5E7EB;
 padding-top: 10px;
 }
 .total-box {
 background: #EEF2FF;
 padding: 15px;
 border-radius: 5px;
 margin-top: 20px;
 text-align: right;
 font-weight: bold;
 color: #4F46E5;
 }
 </style>
</head>
<body>
 <div class="header">
 <h1>{{ $titulo }}</h1>
 <div class="subtitle">Sistema de Gestión de Usuarios</div>
 </div>
 <div class="info-box">
 <table>
 <tr>
 <td class="label">Fecha de generación:</td>
 <td>{{ $fecha }}</td>
 <td class="label">Filtro aplicado:</td>
 <td>{{ ucfirst($filtro_role) }}</td>
 </tr>
 <tr>
 <td class="label">Total de registros:</td>
 <td>{{ $total }}</td>
 <td class="label">Generado por:</td>
 <td>Sistema Automático</td>
 </tr>
 </table>
 </div>
 <table class="data">
 <thead>
 <tr>
 <th style="width: 5%;">ID</th>
 <th style="width: 30%;">Nombre</th>
 <th style="width: 35%;">Email</th>
 <th style="width: 15%;">Rol</th>
 <th style="width: 15%;">Fecha Registro</th>
 </tr>
 </thead>
 <tbody>
 @forelse($usuarios as $usuario)
 <tr>
 <td>{{ $usuario->id }}</td>
 <td>{{ $usuario->name }}</td>
 <td>{{ $usuario->email }}</td>
 <td>
 <span class="badge badge-{{ $usuario->role }}">
 {{ strtoupper($usuario->role) }}
 </span>
 </td>
 <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
 </tr>
 @empty
 <tr>
 <td colspan="5" style="text-align: center; padding: 20px; color: #9CA3AF;">
 No hay usuarios registrados
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 <div class="total-box">
 Total de usuarios en este reporte: {{ $total }}
 </div>
 <div class="footer">
 <p>Sistema de Gestión - Reporte generado automáticamente</p>
 <p>© {{ date('Y') }} - Todos los derechos reservados</p>
 </div>
</body>
</html>