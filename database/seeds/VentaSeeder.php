<?php

use Illuminate\Database\Seeder;
use App\Models\Venta;

class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Venta::class,100000)->create();
    }
}
