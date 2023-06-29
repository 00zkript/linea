<?php

namespace App;

use App\Models\Cliente;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $table = "usuario";
    protected $primaryKey = "idusuario";
    protected $rememberTokenName = "";

    public $timestamps = true;
    // public const CREATED_AT = 'creado';
    // public const UPDATED_AT = 'actualizado';


    public function sucursal()
    {
        return $this->hasOne(Models\Sucursal::class, 'idsucursal', 'idsucursal')->withDefault([
            'idsucursal' => null,
            'nombre' => 'Sin sucursal'
        ]);
    }



}
