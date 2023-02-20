<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

/**
 * Class Contrato
 *
 * @property $id
 * @property $folio
 * @property $cliente_id
 * @property $fecha_firma
 * @property $fecha_inicio
 * @property $fecha_cierre_siroc
 * @property $fecha_termino
 * @property $monto_anticipo
 * @property $importe_contratado
 * @property $suministros
 * @property $total_contrato
 * @property $porcentaje_amortizacion_anticipo
 * @property $concepto_adenda
 * @property $descripcion_contrato
 * @property $licencia
 * @property $calle
 * @property $no_ext
 * @property $no_int
 * @property $colonia
 * @property $localidad
 * @property $referencia
 * @property $municipio_id
 * @property $estado_id
 * @property $codigo_postal_id
 * @property $permite_deductivas
 * @property $porcentaje_retencion
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property CodigosPostale $codigosPostale
 * @property Estado $estado
 * @property Municipio $municipio
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Contrato extends Model implements AuditableContracts
{
    use HasFactory, SoftDeletes, Auditable, Notifiable, GeneratesUuid;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'folio',
        'tipo',
        'cliente_id',
        'fecha_firma',
        'fecha_inicio',
        'fecha_cierre_siroc',
        'fecha_termino',
        'monto_anticipo',
        'importe_contratado',
        'suministros',
        'total_contrato',
        'porcentaje_amortizacion_anticipo',
        'porcentaje_retencion',
        'concepto_adenda',
        'descripcion_contrato',
        'licencia',
        'calle',
        'no_ext',
        'no_int',
        'colonia',
        'localidad',
        'referencia',
        'municipio_id',
        'estado_id',
        'codigo_postal',
        'permite_deductivas',
        'permite_aditivas',
        'estado_partidas',
        'documento_partidas',
        'model_id',
        'model_type',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id', 'cliente_id')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function estado()
    {
        return $this->hasOne(Estado::class, 'id', 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function municipio()
    {
        return $this->hasOne(Municipio::class, 'id', 'municipio_id');
    }

    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }

    public function estimaciones()
    {
        return $this->hasMany(Estimacion::class);
    }

    public function obrasExtras()
    {
        return $this->hasMany(ObraExtra::class);
    }

    public function model()
    {
        return $this->morphTo();
    }

    public function postVenta()
    {
        return $this->hasMany(PostVenta::class);
    }

    public function control()
    {
        return $this->hasMany(ControlObra::class);
    }

    public function getRouteKeyName(): string
    {
        return 'uid';
    }

    public function uuidColumn(): string
    {
        return 'uid';
    }

    public function scopeSearch($query, $valor, $activo)
    {
        return $query->with('cliente:id,razon_social')
            ->when($activo == 2, fn($query) => $query->onlyTrashed())
            ->when($activo == 0, fn($query) => $query->withTrashed())
            ->when(empty($valor) == false, function ($query) use ($valor) {
                return $query
                    ->where(function ($query) use ($valor) {
                        $v = '%' . preg_replace('/[^A-Za-z0-9]/', '', $valor) . '%';
                        $query->where('folio', 'LIKE', '%' . $valor . '%')
                            ->orWhereHas('cliente', function ($query) use ($v) {
                                $query->whereRaw("regexp_replace(razon_social, '[^A-Za-z0-9]','') LIKE ?", [$v]);
                            });
                    });
            })
            ->orderBy('folio');
    }

    public function scopeContrato($query, $valor)
    {
        return $query
            ->with('cliente:id,razon_social,expediente')
            ->when(empty($valor) == false, function ($query) use ($valor) {
                return $query
                    ->where(function ($query) use ($valor) {
                        $v = '%' . preg_replace('/[^A-Za-z0-9]/', '', $valor) . '%';
                        $query->where('folio', 'LIKE', '%' . $valor . '%')
                            ->orWhereDate('fecha_firma', $valor)
                            ->orWhereHas('cliente', function ($query) use ($v) {
                                $query->whereRaw("regexp_replace(razon_social, '[^A-Za-z0-9]','') LIKE ?", [$v]);
                            });
                    });
            })
            ->orderBy('folio');

    }
}
