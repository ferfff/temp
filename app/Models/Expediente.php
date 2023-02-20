<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

class Expediente extends Model implements AuditableContracts
{
    use HasFactory, SoftDeletes, Auditable, GeneratesUuid;

    protected $fillable = ['nombre', 'extension', 'ruta', 'comentario', 'condicion_id', 'documento_id', 'contrato_id', 'grupo', 'seguimiento', 'aplazamiento', 'nodo_id'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id');
    }

    public function documento()
    {
        return $this->belongsTo(DefinicionDocumento::class, 'documento_id');
    }

    public function condicion()
    {
        return $this->belongsTo(Condicion::class, 'condicion_id');
    }

    public function bitacora()
    {
        return $this->morphMany(BitacoraMovimiento::class, 'model');
    }

    public function nodo()
    {
        return $this->belongsTo(Expediente::class, 'nodo_id');
    }

    public function seguidos()
    {
        return $this->hasMany(Expediente::class, 'nodo_id');
    }
}
