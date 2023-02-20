<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

/**
 * Class DestajoObra
 *
 * @property $id
 * @property $control_id
 * @property $cantidad
 * @property $importe
 * @property $created_at
 * @property $updated_at
 *
 * @property ControlObra $controlObra
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DestajoObra extends Model implements AuditableContracts
{
    use HasFactory, Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['control_id', 'cantidad', 'importe', 'importe_iva', 'estimacion'];

    public function controlObra()
    {
        return $this->belongsTo(ControlObra::class, 'control_id');
    }
}
