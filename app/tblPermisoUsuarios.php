<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tblPermisoUsuarios extends Model
{
    protected $fillable = [
        'run_usuario', 'idAplicacion','idAccesoUsuario', 'estado_login'
    ];
}
