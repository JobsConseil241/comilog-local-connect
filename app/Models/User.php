<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_ADMIN_COMILOG = 'admin_comilog';
    public const ROLE_ADMIN_ANPI = 'admin_anpi';
    public const ROLE_PME = 'pme';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'pme_id',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pme(): BelongsTo
    {
        return $this->belongsTo(Pme::class);
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, [self::ROLE_ADMIN_COMILOG, self::ROLE_ADMIN_ANPI], true);
    }

    public function isAdminComilog(): bool
    {
        return $this->role === self::ROLE_ADMIN_COMILOG;
    }

    public function isAdminAnpi(): bool
    {
        return $this->role === self::ROLE_ADMIN_ANPI;
    }

    public function isPme(): bool
    {
        return $this->role === self::ROLE_PME;
    }
}
