<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstimacionArchivo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'estimacion_archivo';

    protected $fillable = ['nombre', 'extension', 'tipo', 'estimacion_id'];

    public function estimacion()
    {
        return $this->belongsTo(Estimacion::class, 'estimacion_id');
    }

    public function bitacora()
    {
        return $this->morphMany(BitacoraMovimiento::class, 'model');
    }
}
