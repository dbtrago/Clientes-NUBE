<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interaccion extends Model
{
    protected $table = 'interacciones';

    protected $fillable = [
        'cliente_id',
        'tipo',
        'descripcion',
        'fecha',
    ];

    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
