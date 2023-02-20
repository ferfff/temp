<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

class Archivo extends Model implements AuditableContracts
{

    use Auditable;

    public $timestamps = false;

    protected $fillable = ['documento', 'tipo_id', 'obra_extra_id'];

    public function obraExtra()
    {
        return $this->belongsTo(ObraExtra::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }
}
