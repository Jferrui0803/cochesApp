<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Coche;
use Illuminate\Database\Seeder;

class SemillaParaCrearCoche extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $marcas = [
            'Toyota' => ['Corolla', 'Camry', 'RAV4', 'Yaris'],
            'Ford' => ['Focus', 'Fiesta', 'Mustang', 'Kuga'],
            'Volkswagen' => ['Golf', 'Polo', 'Passat', 'Tiguan'],
            'BMW' => ['Serie 1', 'Serie 3', 'Serie 5', 'X3'],
            'Mercedes' => ['Clase A', 'Clase C', 'Clase E', 'GLA'],
            'Audi' => ['A3', 'A4', 'Q3', 'Q5'],
            'Seat' => ['Ibiza', 'Leon', 'Arona', 'Ateca'],
            'Renault' => ['Clio', 'Megane', 'Captur', 'Kadjar']
        ];

        for ($i = 0; $i < 123; $i++) {
            $marca = array_rand($marcas);
            $modelos = $marcas[$marca];
            Coche::create([
                'marca' => $marca,
                'modelo' => $modelos[array_rand($modelos)],
                'precio' => rand(5000000, 100000000) / 100,
            ]);
        }
    }
}
