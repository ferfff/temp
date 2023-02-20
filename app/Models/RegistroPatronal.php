<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

/**
 * Class RegistrosPatronale
 *
 * @property $id
 * @property $razon_social
 * @property $razon_comercial
 * @property $RFC
 * @property $registro_patronal_imss
 * @property $logotipo
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RegistroPatronal extends Model implements AuditableContracts
{

    use HasFactory, Auditable, Sluggable;

    protected $table = 'registros_patronales';

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['razon_social', 'slug', 'razon_comercial', 'RFC', 'registro_patronal_imss', 'logotipo'];

    public function obras()
    {
        return $this->hasMany(Obra::class, 'registro_patronal_id');
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
