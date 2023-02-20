<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

/**
 * Class Siroc
 *
 * @property $id
 * @property $folio
 * @property $descripcion
 * @property $cliente_id
 * @property $presupuesto_id
 * @property $imss
 * @property $archivo
 * @property $fecha_firma
 * @property $fecha_cierre_siroc
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property Presupuesto $presupuesto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Siroc extends Model implements AuditableContracts
{

    use HasFactory, Auditable, GeneratesUuid;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['uid', 'folio', 'descripcion', 'cliente_id', 'presupuesto_id', 'imss', 'archivo', 'fecha_firma', 'fecha_cierre_siroc'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function contrato()
    {
        return $this->morphOne(Contrato::class, 'model');
    }

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class);
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
