<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;
use Znck\Eloquent\Traits\BelongsToThrough;

/**
 * Class CodigosPostale
 *
 * @property $id
 * @property $CP
 * @property $municipio_id
 *
 * @property Colonia[] $colonias
 * @property Contrato[] $contratos
 * @property Municipio $municipio
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CodigoPostal extends Model implements AuditableContracts
{

    use Auditable, Sluggable, BelongsToThrough;

    protected $table = 'codigos_postales';

    public $timestamps = false;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['CP', 'slug', 'municipio_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function colonias()
    {
        return $this->hasMany(Colonia::class, 'codigo_postal_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contratos()
    {
        return $this->hasMany(Contrato::class, 'codigo_postal_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function municipio()
    {
        return $this->hasOne(Municipio::class, 'id', 'municipio_id');
    }

    public function estado()
    {
        return $this->belongsToThrough(
            Estado::class,
            Municipio::class,
        );
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
                'source' => 'CP',
            ],
        ];
    }

}
