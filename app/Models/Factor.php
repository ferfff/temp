<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

/**
 * Class Factore
 *
 * @property $id
 * @property $SDI
 * @property $SD
 * @property $salario
 * @property $puntualidad
 * @property $asistencia
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Factor extends Model implements AuditableContracts
{

    use HasFactory, Auditable;

    protected $table = 'factores';

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['SDI', 'SD', 'salario', 'puntualidad', 'asistencia'];

}
