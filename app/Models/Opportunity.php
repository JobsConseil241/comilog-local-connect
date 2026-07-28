<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Opportunity extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';
    public const STATUS_CLOSED = 'closed';

    public const TYPES = [
        'appel_offres' => "Appel d'offres",
        'consultation' => 'Consultation',
        'devis' => 'Demande de devis',
        'manifestation_interet' => "Manifestation d'intérêt",
    ];

    protected $fillable = [
        'reference',
        'titre',
        'description',
        'type',
        'deadline',
        'budget_estime',
        'lieu_execution',
        'contact_email',
        'contact_nom',
        'piece_jointe',
        'status',
        'published_at',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'published_at' => 'datetime',
        ];
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BusinessCategory::class, 'opportunity_business_category');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function interests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OpportunityInterest::class);
    }

    public function isInterestedBy(?Pme $pme): bool
    {
        if (! $pme) {
            return false;
        }

        return $this->interests()->where('pme_id', $pme->id)->exists();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PUBLISHED)
            ->where(function (Builder $q) {
                $q->whereNull('deadline')->orWhere('deadline', '>=', now()->toDateString());
            });
    }

    public function scopeForCategories(Builder $query, array $categoryIds): Builder
    {
        return $query->whereHas('categories', fn (Builder $q) => $q->whereIn('business_categories.id', $categoryIds));
    }

    public function isOpen(): bool
    {
        return $this->status === self::STATUS_PUBLISHED
            && (! $this->deadline || $this->deadline->isFuture() || $this->deadline->isToday());
    }
}
