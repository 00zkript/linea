<?php

use Illuminate\Database\Seeder;

class UbigeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departamentos = file_get_contents(public_path('panel/ubigeo/departamento.json'));
        $provincias = file_get_contents(public_path('panel/ubigeo/provincia.json'));
        $distritos = file_get_contents(public_path('panel/ubigeo/distrito.json'));

        foreach (json_decode($departamentos) as $item) {
            $departamento = new \App\Models\Departamento();
            $departamento->iddepartamento = $item->iddepartamento;
            $departamento->nombre = $item->nombre;
            $departamento->estado = 1;
            $departamento->save();
        }


        foreach (json_decode($provincias) as $item) {
            $provincia = new \App\Models\Provincia();
            $provincia->idprovincia = $item->idprovincia;
            $provincia->iddepartamento = $item->iddepartamento;
            $provincia->nombre = $item->nombre;
            $provincia->estado = 1;
            $provincia->save();
        }

        foreach (json_decode($distritos) as $item) {
            $distrito = new \App\Models\Distrito();
            $distrito->iddistrito = $item->iddistrito;
            $distrito->idprovincia = $item->idprovincia;
            $distrito->iddepartamento = $item->iddepartamento;
            $distrito->nombre = $item->nombre;
            $distrito->estado = 1;
            $distrito->save();
        }


    }
}
