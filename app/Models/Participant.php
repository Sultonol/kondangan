<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'phone',
        'avatar',
        'joined_at',
        'is_online',
        'last_seen'
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'last_seen' => 'datetime',
        'is_online' => 'boolean'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
