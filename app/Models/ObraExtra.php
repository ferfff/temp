<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;
use Znck\Eloquent\Traits\BelongsToThrough;

/**
 * Class ObrasExtra
 *
 * @property $id
 * @property $bitacora
 * @property $contrato_id
 * @property $presupuesto
 * @property $monto_original
 * @property $created_at
 * @property $updated_at
 *
 * @property Archivo[] $archivos
 * @property Contrato $contrato
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ObraExtra extends Model implements AuditableContracts
{
    use HasFactory, BelongsToThrough, Auditable;

    protected $table = 'obras_extras';

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['bitacora', 'contrato_id', 'presupuesto', 'monto_original', 'aprobacion', 'primera_firma', 'firmas_completas'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function archivos()
    {
        return $this->hasMany(Archivo::class, 'obra_extra_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function contratoCliente()
    {
        return $this->belongsToThrough(Cliente::class, Contrato::class);
    }
}
