<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

/**
 * Class Estado
 *
 * @property $id
 * @property $nombre
 * @property $codigo_sat
 * @property $created_at
 * @property $updated_at
 *
 * @property Contrato[] $contratos
 * @property Municipio[] $municipios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Estado extends Model implements AuditableContracts
{

    use Auditable, Sluggable;

    public $timestamps = false;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'slug', 'codigo_sat'];

    public function nombre(): Attribute
    {
        return new Attribute(
            get:fn($value) => ucwords(mb_strtolower($value, 'UTF-8')),
            set:fn($value) => mb_strtoupper($value, 'UTF-8'),
        );
    }

    public function codigoSat(): Attribute
    {
        return new Attribute(
            //get:fn($value) => ucwords(mb_strtolower($value, 'UTF-8')),
            set:fn($value) => mb_strtoupper($value, 'UTF-8'),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function municipios()
    {
        return $this->hasMany(Municipio::class);
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
