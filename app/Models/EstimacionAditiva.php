<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimacionAditiva extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = ['concepto', 'cantidad', 'estimacion_id'];

    public function estimacion()
    {
        return $this->belongsTo(Estimacion::class, 'estimacion_id');
    }
}
