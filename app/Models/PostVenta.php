<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PostVenta
 *
 * @property $id
 * @property $nombre
 * @property $contrato_id
 * @property $monto
 * @property $fecha_recepcion
 * @property $archivo
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Contrato $contrato
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PostVenta extends Model
{

    use HasFactory;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'contrato_id', 'monto', 'fecha_recepcion', 'archivo', 'estado'];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class)->withTrashed();
    }
}
