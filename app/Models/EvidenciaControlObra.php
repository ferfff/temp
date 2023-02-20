<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidenciaControlObra extends Model
{
    use HasFactory;

    protected $fillable = ['control_id', 'foto', 'comentario'];

    public function createdAt(): Attribute
    {
        return new Attribute(
            get:fn($value) => date("d/m/Y H:i:s", strtotime($value)),
        );
    }

    public function control()
    {
        return $this->belongsTo(ControlObra::class, 'control_id');
    }
}
