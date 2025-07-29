<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'bank_name',
        'account_number',
        'account_holder',
        'bank_logo'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function getBankLogoUrlAttribute()
    {
        return $this->bank_logo ? asset('storage/' . $this->bank_logo) : null;
    }
}
