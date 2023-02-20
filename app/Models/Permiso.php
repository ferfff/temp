<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * Class Permission
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $guard_name
 * @property $created_at
 * @property $updated_at
 *
 * @property ModelHasPermission $modelHasPermission
 * @property RoleHasPermission $roleHasPermission
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Permiso extends SpatiePermission implements AuditableContracts
{

    use Auditable, Sluggable;

    protected $perPage = 20;

    public function name(): Attribute
    {
        return new Attribute(
            set:fn($value) => strtolower($value),
        );
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
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
                'source' => 'name',
            ],
        ];
    }
}
