<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ClienteCorreo extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['nombre', 'titulo', 'correo', 'tipo_correo', 'tipo_proceso', 'cliente_id'];

    protected $appends = ['nombre_completo'];

    public $incrementing = false;

    public function correo(): Attribute
    {
        return new Attribute(
            set:fn($value) => mb_strtolower($value),
        );
    }

    public function getNombreCompletoAttribute()
    {
        return "{$this->titulo} {$this->nombre}";
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
