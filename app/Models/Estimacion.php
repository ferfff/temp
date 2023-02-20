<?php

namespace App\Models;

use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

class Estimacion extends Model implements AuditableContracts
{
    use HasFactory, Auditable, GeneratesUuid;

    protected $table = 'estimaciones';

    protected $perPage = 20;

    protected $fillable = [
        'contrato_id',
        'fecha_estimacion',
        'no_estimacion',
        'monto_ejecutar',
        'monto_facturar',
        'estado',
        'comentario',
        'retencion_monto',
        'retencion_porcentaje',
        'total_facturar',
        'amortizacion_monto',
        'amortizacion_porcentaje',
        'fecha_pago',
        'complemento_pago',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function bitacora()
    {
        return $this->morphMany(BitacoraMovimiento::class, 'model');
    }

    public function deductivas()
    {
        return $this->hasMany(EstimacionDeductiva::class, 'estimacion_id');
    }

    public function aditivas()
    {
        return $this->hasMany(EstimacionAditiva::class, 'estimacion_id');
    }

    public function archivos()
    {
        return $this->hasMany(EstimacionArchivo::class, 'estimacion_id');
    }
    public function notas()
    {
        return $this->hasMany(NotaCredito::class, 'estimacion_id');
    }
}
