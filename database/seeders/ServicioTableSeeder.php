<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioTableSeeder extends Seeder
{
    public function run()
    {
        Servicio::truncate();

        Servicio::create(['nombre' => 'Corte de cabello', 'precio' => 15000]);
        Servicio::create(['nombre' => 'Manicure', 'precio' => 12000]);
        Servicio::create(['nombre' => 'Pedicure', 'precio' => 13000]);
        Servicio::create(['nombre' => 'Tinte completo', 'precio' => 30000]);
        Servicio::create(['nombre' => 'Mascarilla facial', 'precio' => 18000]);
    }
}