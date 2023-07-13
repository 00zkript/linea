<?php

namespace App;


use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $table = "usuario";
    protected $primaryKey = "idusuario";
    // protected $rememberTokenName = "";

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
    public function rol()
    {
        return $this->hasOne(Role::class, 'id', 'idrol')->withDefault([
            'id' => null,
            'name' => 'Sin rol'
        ]);
    }


    public function tipoDocumentoIdentidad()
    {
        return $this->hasOne(Models\TipoDocumentoIdentidad::class, 'idtipo_documento_identidad', 'idtipo_documento_identidad')
            ->withDefault([
                'nombre' => 'Sin documento'
            ]);
    }




}
