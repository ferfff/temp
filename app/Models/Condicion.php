<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condicion extends Model
{
    use HasFactory;

    protected $table = 'condiciones';

    protected $fillable = ['nombre'];

    public $timestamps = false;

    public function expediente()
    {
        return $this->hasOne(Expediente::class);
    }
}
