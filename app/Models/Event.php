<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'groom_name',
        'bride_name',
        'event_date',
        'location',
        'dress_code_image',
        'schedule',
        'bank_name',
        'account_number',
        'account_holder',
        'invitation_code',
        'is_active'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'schedule' => 'array',
        'is_active' => 'boolean'
    ];

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(Media::class);
    }
}
