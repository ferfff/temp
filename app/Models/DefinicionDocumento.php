<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;
use Znck\Eloquent\Traits\BelongsToThrough;

/**
 * Class DefinicionDocumento
 *
 * @property $id
 * @property $nombre
 * @property $obligatorio
 * @property $solicita_aprobacion
 * @property $solicita_comentario
 * @property $ciclo_id
 * @property $multiple
 * @property $referencia
 * @property $seguimiento
 * @property $activo
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DefinicionDocumento extends Model implements AuditableContracts
{

    use Auditable, Sluggable, SoftDeletes, BelongsToThrough, GeneratesUuid;

    protected $perPage = 20;

    protected $with = ['ciclo'];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'slug', 'obligatorio', 'solicita_aprobacion', 'solicita_comentario', 'ciclo_id', 'multiple', 'referencia', 'seguimiento', 'aplazamiento'];

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'ciclo_id');
    }

    public function archivos()
    {
        return $this->hasMany(Archivo::class, 'documento_id');
    }

    public function expedientes()
    {
        return $this->hasMany(Expediente::class, 'documento_id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getDocumentoAttribute($value)
    {
        return "[{$this->ciclo->nombre}] - {$this->nombre}";
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nombre',
            ],
        ];
    }

}
