<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitacoraAcceso extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        //'created_at',
    ];

    public function createdAt(): Attribute
    {
        return new Attribute(
            get:fn($value) => Carbon::parse($value)->format('d-m-Y H:i:s'),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
