<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContracts;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements AuditableContracts
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes, Auditable, Sluggable;

    protected $perPage = 20;

    protected $appends = ['fullName'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'password',
        'image',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Name(): Attribute
    {
        return new Attribute(
            get:fn($value) => mb_strtoupper($value),
            set:fn($value) => ucfirst($value),
        );
    }

    public function ApellidoPaterno(): Attribute
    {
        return new Attribute(
            get:fn($value) => mb_strtoupper($value),
            set:fn($value) => ucfirst($value),
        );
    }

    public function ApellidoMaterno(): Attribute
    {
        return new Attribute(
            get:fn($value) => mb_strtoupper($value),
            set:fn($value) => ucfirst($value),
        );
    }

    public function getFullNameAttribute()
    {
        return $this->name . " " . $this->apellido_paterno . " " . $this->apellido_materno;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name', 'apellido_paterno', 'apellido_materno'],
            ],
        ];
    }

    public function adminlte_image()
    {
        $img = Auth()->user()->image;
        return $img != null ? asset($img) : asset('img/Silueta.png');
    }

    public function adminlte_desc()
    {
        return Auth()->user()->roles->first()->name;
    }

    public function adminlte_profile_url()
    {
        return route('perfil.edit', Auth()->user()->slug);
    }

    public function routeNotificationForWhatsApp()
    {
        return $this->phone_number;
    }
}
