<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'hora', 'usuarioId'];

    protected $table = 'citas';

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuarioId');
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'citasServicios', 'citaId', 'servicioId');
    }
}