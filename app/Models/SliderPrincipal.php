<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

class SliderPrincipal extends Model implements AuditableContracts
{
    use HasFactory, Auditable;

    protected $table = 'slider_principal';

    protected $fillable = ['texto', 'user_id', 'activo'];
}
