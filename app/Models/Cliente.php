<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

/**
 * Class Cliente
 *
 * @property $id
 * @property $razon_social
 * @property $RFC
 * @property $contacto
 * @property $registro_patronal
 * @property $repse
 * @property $presupuesto
 * @property $siroc
 * @property $expediente
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Contrato[] $contratos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model implements AuditableContracts
{
    use HasFactory, Auditable, Sluggable, SoftDeletes;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['razon_social', 'RFC', 'contacto', 'registro_patronal', 'repse', 'presupuesto', 'siroc', 'expediente'];

    public function RFC(): Attribute
    {
        return new Attribute(
            set:fn($value) => strtoupper($value),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contratos()
    {
        return $this->hasMany('App\Models\Contrato', 'cliente_id', 'id');
    }

    public function correos()
    {
        return $this->hasMany(ClienteCorreo::class);
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
                'source' => 'razon_social',
            ],
        ];
    }
}
