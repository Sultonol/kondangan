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
        'invitation_code',
        'is_active'
    ];

    protected $casts = [
        'event_date' => 'datetime',
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

    public function schedules(): HasMany
    {
        return $this->hasMany(EventSchedule::class)->orderBy('order')->orderBy('start_time');
    }

    public function banks(): HasMany
    {
        return $this->hasMany(EventBank::class);
    }

    // Helper methods for media types - Pastikan relasi benar
    public function images(): HasMany
    {
        return $this->hasMany(Media::class)->where('type', 'image');
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Media::class)->where('type', 'video');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Media::class)->where('type', 'document');
    }

    // Helper method to get dress code image URL
    public function getDressCodeImageUrlAttribute()
    {
        return $this->dress_code_image ? asset('storage/' . $this->dress_code_image) : null;
    }
}
