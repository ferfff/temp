<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jornale
 *
 * @property $id
 * @property $NSS
 * @property $nombre_completo
 * @property $departamento
 * @property $curp
 * @property $dias_laborados
 * @property $SDI
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Jornal extends Model
{

    use Sluggable, HasFactory;

    protected $table = 'jornales';

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['NSS', 'slug', 'nombre_completo', 'departamento', 'curp', 'dias_laborados', 'SDI'];

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
                'source' => ['departamento', 'nombre_completo'],
            ],
        ];
    }
}
