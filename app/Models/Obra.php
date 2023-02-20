<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

/**
 * Class Obra
 *
 * @property $id
 * @property $registro_patronal_id
 * @property $clave_obra
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property RegistrosPatronale $registrosPatronale
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Obra extends Model implements AuditableContracts
{
    use HasFactory, Auditable, Sluggable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['registro_patronal_id', 'clave_obra', 'slug', 'nombre', 'etapa', 'residente', 'presupuesto', 'direccion', 'fecha_inicio', 'fecha_termino'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function registroPatronal()
    {
        return $this->belongsTo(RegistroPatronal::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
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
                'source' => ['clave_obra', 'nombre'],
            ],
        ];
    }

}
