<?php

use App\Models\Cliente;
use App\Models\Comprobante;
use App\Models\Contacto;
use App\Models\CostoEnvio;
use App\Models\Empresa;
use App\Models\EstadoControlVenta;
use App\Models\EstadoEnvio;
use App\Models\EstadoPago;
use App\Models\MetodoPago;
use App\Models\Seo;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(VentaSeeder::class);
        //$this->call(CategoriaSeeder::class);
        // $this->call(MarcaSeeder::class);
        //$this->call(UsuarioSeeder::class);

        $compobantes = ["boleta","factura"];

        foreach ($compobantes as $item) {
            $comprobante = new Comprobante();
            $comprobante->nombre = $item;
            $comprobante->nro_serie = 1;
            $comprobante->estado = 1;
            $comprobante->save();
        }


        $contacto = new Contacto();
        $contacto->telefono = '987654321';
        $contacto->celular = '987654321';
        $contacto->correo = 'venta@example.com';
        $contacto->facebook = 'facebook';
        $contacto->whatsapp = 'quiero información';
        $contacto->instagram = 'instagram';
        $contacto->twitter = 'twitter';
        $contacto->direccion = 'direccion tienda';
        $contacto->save();



        $precioEnvio = new CostoEnvio();
        $precioEnvio->precio      = "15.00";
        $precioEnvio->descripcion = "descripción del envío";
        $precioEnvio->restriccion = "restrición del envío";
        $precioEnvio->estado      = 1;
        $precioEnvio->save();


        $usuario = new User();
        $usuario->idrol = 1;
        $usuario->nombres = "Admin";
        $usuario->usuario = "admin";
        $usuario->correo = "admin@example.com";
        $usuario->clave = encrypt('123456789');
        $usuario->estado = 1;
        $usuario->save();


        $cliente = new Cliente();
        $cliente->nombres = "Admin";
        $cliente->correo = "admin@example.com";
        $cliente->estado = 1;
        $cliente->idusuario = 1;
        $cliente->save();


        Empresa::query()->create([
            "nombre" =>"empresa",
//            "favicon" => "favicon-default.jpg",
//            "logo" => "logo-default.jpg",
//            "logo2" => "logo-default2.jfif",
            "idmoneda" => 2,
            "igv" => "18.00",
        ]);


        $estadoContols = [
            "PROCESADA",
            "FINALIZADA",
            "ANULADA",
        ];

        foreach ($estadoContols as $item) {
            $estadoControlventa = new EstadoControlVenta();
            $estadoControlventa->nombre = $item;
            $estadoControlventa->estado = 1;
            $estadoControlventa->save();
        }



        $estadoEnvios = [
            'en espera',
            'enviado',
            'entregado',
            'devuelto',
            'no se entregaran',
        ];

        foreach ($estadoEnvios as $item) {
            $estadoEnvio = new EstadoEnvio();
            $estadoEnvio->nombre = $item;
            $estadoEnvio->estado = 1;
            $estadoEnvio->save();
        }



        $estadopagos = [
            'pagado',
            'espera de pago',
            'Cancelado',
            'Reembolsado',
        ];

        foreach ($estadopagos as $item) {
            $estadopago = new EstadoPago();
            $estadopago->nombre = $item;
            $estadopago->estado = 1;
            $estadopago->save();
        }



        $metodopagos = [
            'TARJETA-CREDITO',
            'CONTRAENTREGA-EFECTIVO',
            'PAGO-DEPOSITO-BANCARIO',
            'PAGO-EFECTIVO',
            'MERCADOPAGO',
            'IZIPAY',
        ];

        foreach ($metodopagos as $item) {
            $metodopago = new MetodoPago();
            $metodopago->descripcion = $item;
            $metodopago->estado = 1;
            $metodopago->save();
        }




        DB::insert('insert  into rol(idrol,cargo,estado) values (?,?,?);', [1, 'Administrador',1]);
        DB::insert('insert  into rol(idrol,cargo,estado) values (?,?,?);', [2, 'Usuario',1]);




        $seo1 = new Seo();
        $seo1->titulo_general = 'Empresa';
        $seo1->autor = 'Author Empresa';
        $seo1->descripcion = 'Descripcion Empresa';
        $seo1->keywords = 'Keywords Empresa';
        $seo1->save();


        $tiposDOucmnentos = [
            'DNI',
            'CARNET DE EXTRANJERIA',
            'RUC',
            'PASAPORTE',
        ];

        foreach ($tiposDOucmnentos as $key => $item) {
            $tipoDoc = new \App\Models\TipoDocumentoIdentidad();
            $tipoDoc->nombre = $item;
            $tipoDoc->orden = $key+1;
            $tipoDoc->estado = 1;
            $tipoDoc->save();
        }


        \App\Models\TipoRuta::query()->insert([
            ['nombre' => 'Sin ruta', 'slug' => 'sin-ruta', 'is_internal' => 0 , 'route_alias' => null, 'estado' => 1,],
            ['nombre' => 'Externa', 'slug' => 'externa', 'is_internal' => 0 , 'route_alias' => null, 'estado' => 1,],
            ['nombre' => 'Interna (Estatica)', 'slug' => 'interna-estatica', 'is_internal' => 1 , 'route_alias' => null, 'estado' => 1,],
            ['nombre' => 'Interna (Categoria)', 'slug' => 'interna-categoria', 'is_internal' => 1 , 'route_alias' => "web.productos.categoria", 'estado' => 1,],
            ['nombre' => 'Interna (Pagina)', 'slug' => 'interna-pagina', 'is_internal' => 1 , 'route_alias' => "web.pagina.detalle", 'estado' => 1,],
            ['nombre' => 'Interna (Producto)', 'slug' => 'interna-producto', 'is_internal' => 1 , 'route_alias' => "web.producto.detalle", 'estado' => 0,],
        ]);



        \App\Models\TerminosCondiciones::query()->create([
            "contenido" => "",
        ]);

        \App\Models\PoliticaPrivacidad::query()->create([
            "contenido" => "",
        ]);


        \App\Models\MetodoEntrega::query()->create([
            "nombre" => "ENVIO A DOMICILIO",
            "estado" => 1
        ]);

        \App\Models\MetodoEntrega::query()->create([
            "nombre" => "RECOJO EN TIENDA",
            "estado" => 1
        ]);


        \App\Models\Moneda::query()->create([
            "nombre" => "DOLARES",
            "moneda" => "USD",
            "simbolo" => "$",
            "cambio" => "1.00",
            "estado" => 1
        ]);

        \App\Models\Moneda::query()->create([
            "nombre" => "SOLES",
            "moneda" => "PEN",
            "simbolo" => "S/",
            "cambio" => "1.00",
            "estado" => 1
        ]);


        \App\Models\Atributo::query()->insert([
                ['nombre' => 'colores' , 'slug' => 'colores','estado' => 1],
                ['nombre' => 'tallas' , 'slug' => 'tallas','estado' => 1],
                ['nombre' => 'tamaño' , 'slug' => 'tamano','estado' => 1],
                ['nombre' => 'presentación' , 'slug' => 'presentacion','estado' => 1],
                ['nombre' => 'tipo' , 'slug' => 'tipo','estado' => 1],
                ['nombre' => 'distribución' , 'slug' => 'distribucion','estado' => 1],
                ['nombre' => 'modelo' , 'slug' => 'modelo','estado' => 1],
        ]);

        \App\Models\BannerTipo::query()->insert([
            [ 'nombre' => 'Imagen', 'slug' => 'imagen', 'estado' => 1],
            [ 'nombre' => 'Video', 'slug' => 'video', 'estado' => 1],
        ]);






        $this->call(UbigeoSeeder::class);




    }
}
