<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

/**
 * Class ControlObra
 *
 * @property $id
 * @property $clave
 * @property $partida
 * @property $unidad
 * @property $cantidad
 * @property $precio_unitario
 * @property $grupo
 * @property $importe
 * @property $contrato_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Contrato $contrato
 * @property DestajoObra[] $destajoObras
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ControlObra extends Model implements AuditableContracts
{
    use HasFactory, SoftDeletes, Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'hash', 'clave', 'partida', 'unidad', 'cantidad', 'precio_unitario', 'codigo_grupo', 'grupo', 'importe', 'contrato_id'];

    //protected $with = ['destajo'];

    public function clave(): Attribute
    {
        return new Attribute(
            set:fn($value) => mb_strtoupper($value),
        );
    }

    public function partida(): Attribute
    {
        return new Attribute(
            set:fn($value) => mb_strtoupper($value),
        );
    }

    public function grupo(): Attribute
    {
        return new Attribute(
            set:fn($value) => ucfirst(mb_strtolower($value)),
        );
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function bitacora()
    {
        return $this->morphMany(BitacoraMovimiento::class, 'model');
    }

    public function evidencias()
    {
        return $this->hasMany(EvidenciaControlObra::class, 'control_id', 'id');
    }

    public function destajos()
    {
        return $this->hasMany(DestajoObra::class, 'control_id', 'id');
    }

    public function definiciones()
    {
        return $this->hasMany(ControlObra::class, 'uuid', 'uuid');
    }
}
