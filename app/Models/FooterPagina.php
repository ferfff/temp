<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;

class FooterPagina extends Model implements AuditableContracts
{
    use HasFactory, Auditable;

    protected $table = 'footer_pagina';

    public $timestamps = false;

    protected $fillable = [
        'aviso_privacidad',
        'aviso_privacidad_resumen',
        'ubicacion',
        'email',
        'telefono',
        'facebook_url',
        'facebook_activo',
        'twitter_url',
        'twitter_activo',
        'instagram_url',
        'instagram_activo',
    ];
}
