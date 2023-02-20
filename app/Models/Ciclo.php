<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

class Ciclo extends Model implements AuditableContracts
{
    use HasFactory, Auditable;

    protected $table = 'ciclo_proyecto';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
    ];

    public function documentos()
    {
        return $this->hasMany(DefinicionDocumento::class);
    }
}
