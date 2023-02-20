<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;
use Znck\Eloquent\Traits\BelongsToThrough;

/**
 * Class Colonia
 *
 * @property $id
 * @property $nombre
 * @property $tipo_asentamiento
 * @property $codigo_postal_id
 *
 * @property CodigosPostale $codigosPostale
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Colonia extends Model implements AuditableContracts
{

    use Auditable, Sluggable, BelongsToThrough;

    public $timestamps = false;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'slug', 'tipo_asentamiento', 'codigo_postal_id'];

    public function nombre(): Attribute
    {
        return new Attribute(
            get:fn($value) => ucwords(mb_strtolower($value, 'UTF-8')),
            set:fn($value) => mb_strtoupper($value, 'UTF-8'),
        );
    }

    public function tipoAsentamiento(): Attribute
    {
        return new Attribute(
            get:fn($value) => ucwords(mb_strtolower($value, 'UTF-8')),
            set:fn($value) => mb_strtoupper($value, 'UTF-8'),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function codigoPostal()
    {
        return $this->hasOne(CodigoPostal::class, 'id', 'codigo_postal_id');
    }

    public function estado()
    {
        return $this->belongsToThrough(
            Estado::class,
            [Municipio::class, CodigoPostal::class],
            null,
            '',
            [CodigoPostal::class => 'codigo_postal_id'],
        );
    }

    public function municipio()
    {
        return $this->belongsToThrough(
            Municipio::class,
            CodigoPostal::class,
            null,
            '',
            [CodigoPostal::class => 'codigo_postal_id']
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
                'source' => ['tipo_asentamiento', 'nombre'],
            ],
        ];
    }

}
