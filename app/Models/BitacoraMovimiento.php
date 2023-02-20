<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

class BitacoraMovimiento extends Model implements AuditableContracts
{
    use HasFactory, Auditable;

    protected $fillable = ['comentario', 'user', 'accion', 'model_id', 'model_type'];

    public function createdAt(): Attribute
    {
        return new Attribute(
            get:fn($value) => date("d/m/Y H:i:s", strtotime($value)),
        );
    }

    public function model()
    {
        return $this->morphTo();
    }
}
