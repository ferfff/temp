<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

/**
 * Class Municipio
 *
 * @property $id
 * @property $nombre
 * @property $estado_id
 *
 * @property CodigosPostale[] $codigosPostales
 * @property Contrato[] $contratos
 * @property Estado $estado
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Municipio extends Model implements AuditableContracts
{

    use Auditable, Sluggable;
    public $timestamps = false;

    protected $perPage = 20;
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'slug', 'estado_id'];

    public function nombre(): Attribute
    {
        return new Attribute(
            get:fn($value) => ucwords(mb_strtolower($value, 'UTF-8')),
            set:fn($value) => mb_strtoupper($value, 'UTF-8'),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function codigosPostales()
    {
        return $this->hasMany(CodigoPostal::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estado()
    {
        return $this->hasOne(Estado::class, 'id', 'estado_id');
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
                'source' => 'nombre',
            ],
        ];
    }

}
