<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'direccion',
        'fecha_registro',
    ];

    public $timestamps = false; // no hay created_at / updated_at

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'cliente_producto')
                    ->withPivot('fecha_adquisicion');
    }

    public function interacciones()
    {
        return $this->hasMany(Interaccion::class, 'cliente_id');
    }
}
