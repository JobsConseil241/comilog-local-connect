<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OpportunityInterest extends Model
{
    protected $fillable = [
        'opportunity_id',
        'pme_id',
        'user_id',
    ];

    public function opportunity(): BelongsTo
    {
        return $this->belongsTo(Opportunity::class);
    }

    public function pme(): BelongsTo
    {
        return $this->belongsTo(Pme::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
