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

    public const CREATED_AT = 'creado';
    public const UPDATED_AT = 'actualizado';




   public function cliente()
   {
       return $this->hasOne(Cliente::class,'idusuario','idusuario')->withDefault([
           "nombres" => "Sin nombre",
           "apellidos" => "Sin apellidos",
       ]);
   }

}
