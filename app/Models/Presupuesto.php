<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

/**
 * Class Presupuesto
 *
 * @property $id
 * @property $folio
 * @property $descripcion
 * @property $cliente_id
 * @property $monto
 * @property $fecha_recepcion
 * @property $archivo
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property Contrato $contrato
 * @property Siroc $sirocs
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Presupuesto extends Model implements AuditableContracts
{

    use HasFactory, Auditable, GeneratesUuid;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['uid', 'folio', 'descripcion', 'cliente_id', 'monto', 'fecha_recepcion', 'archivo', 'estado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contrato()
    {
        return $this->morphOne(Contrato::class, 'model');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function siroc()
    {
        return $this->hasOne(Siroc::class);
    }

    public function bitacora()
    {
        return $this->morphMany(BitacoraMovimiento::class, 'model');
    }

    public function getRouteKeyName(): string
    {
        return 'uid';
    }

    public function uuidColumn(): string
    {
        return 'uid';
    }
}
