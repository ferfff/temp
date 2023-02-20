<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

/**
 * Class NotaCredito
 *
 * @property $id
 * @property $uuid
 * @property $cliente_id
 * @property $estimacion_id
 * @property $folio
 * @property $fecha
 * @property $monto
 * @property $pdf
 * @property $xml
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Cliente $cliente
 * @property Estimacione $estimacione
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class NotaCredito extends Model implements AuditableContracts
{
    use HasFactory, SoftDeletes, Auditable, GeneratesUuid;

    protected $perPage = 20;

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'cliente_id', 'emisor', 'estimacion_id', 'folio', 'fecha', 'monto', 'pdf', 'xml'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function estimacion()
    {
        return $this->belongsTo(Estimacion::class, 'estimacion_id');
    }
}
