<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->increments('idventa');
            $table->integer('idestado_envio')->nullable();
            $table->integer('idcosto_envio')->nullable();
            $table->integer('idestado_control_venta')->nullable();
            $table->integer('idcupon')->nullable();
            $table->decimal('total', 10)->nullable();
            $table->decimal('precio_envio', 10)->nullable();
            $table->decimal('descuento', 10)->nullable();
            $table->decimal('total_final', 10)->nullable();
            $table->integer('idmoneda')->nullable()->default(1);
            $table->double('precio_cambio', 10, 4)->nullable()->default(1);
            $table->integer('idcliente')->nullable();
            $table->string('nombres', 100)->nullable();
            $table->string('apellidos', 100)->nullable();
            $table->string('telefono', 250)->nullable();
            $table->string('correo', 250)->nullable();
            $table->integer('idtipo_documento_identidad')->nullable();
            $table->string('numero_documento_identidad', 15)->nullable();
            $table->integer('idmetodo_entrega')->nullable();
            $table->string('iddepartamento', 50)->nullable();
            $table->string('idprovincia', 50)->nullable();
            $table->string('iddistrito', 50)->nullable();
            // $table->integer('iddireccion')->nullable();
            $table->text('direccion')->nullable();
            $table->text('referencia')->nullable();
            $table->integer('idpunto_venta')->nullable();
            $table->string('otro_receptor', 250)->nullable();
            $table->integer('facturacion_idcomprobante')->nullable();
            $table->string('facturacion_nro_comprobante', 250)->nullable();
            $table->string('facturacion_ruc', 20)->nullable();
            $table->string('facturacion_razon_social', 250)->nullable();
            $table->integer('pago_idmetodo_pago')->nullable();
            $table->integer('pago_idestado_pago')->nullable();
            $table->string('pago_mercadopago_id', 250)->nullable();
            $table->integer('pago_cuotas')->nullable();
            $table->string('pago_cip', 20)->nullable();
            $table->dateTime('pago_expira_cip')->nullable();
            $table->string('pago_email', 250)->nullable();
            $table->dateTime('fecha_registro')->nullable();
            $table->dateTime('fecha_modificacion')->nullable();
            $table->dateTime('fecha_venta')->nullable();
            $table->dateTime('fecha_entrega')->nullable();
            $table->dateTime('fecha_pago')->nullable();
            $table->text('imagen_comprobante_pago')->nullable();
            $table->boolean('estado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta');
    }
}
