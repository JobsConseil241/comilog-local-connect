<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pme extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_SUSPENDED = 'suspended';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'raison_sociale',
        'rccm',
        'nif',
        'ville',
        'telephone',
        'email_contact',
        'representant_nom',
        'representant_fonction',
        'description',
        'status',
        'imported_from_anpi',
        'validated_at',
        'validated_by',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'imported_from_anpi' => 'boolean',
            'validated_at' => 'datetime',
        ];
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BusinessCategory::class, 'pme_business_category');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function validator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }
}
