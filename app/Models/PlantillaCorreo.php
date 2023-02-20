<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantillaCorreo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'img',
        'correo',
        'variables',
    ];
}
