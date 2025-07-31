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
        'session_id',
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

    /**
     * Relationship dengan Event
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Relationship dengan Messages
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Scope untuk participant yang online
     */
    public function scopeOnline($query)
    {
        return $query->where('is_online', true);
    }

    /**
     * Scope untuk participant yang offline
     */
    public function scopeOffline($query)
    {
        return $query->where('is_online', false);
    }

    /**
     * Scope untuk participant berdasarkan event
     */
    public function scopeByEvent($query, $eventId)
    {
        return $query->where('event_id', $eventId);
    }

    /**
     * Scope untuk participant guest (anonymous)
     */
    public function scopeGuest($query)
    {
        return $query->where('name', 'like', 'Guest %');
    }

    /**
     * Scope untuk participant registered (bukan guest)
     */
    public function scopeRegistered($query)
    {
        return $query->where('name', 'not like', 'Guest %');
    }

    /**
     * Method untuk update last seen timestamp
     */
    public function updateLastSeen()
    {
        $this->update([
            'last_seen' => now()
        ]);
        
        return $this;
    }

    /**
     * Method untuk set online status
     */
    public function setOnline($status = true)
    {
        $this->update([
            'is_online' => $status,
            'last_seen' => now()
        ]);
        
        return $this;
    }

    /**
     * Method untuk set offline status
     */
    public function setOffline()
    {
        return $this->setOnline(false);
    }

    /**
     * Check apakah participant adalah guest
     */
    public function isGuest(): bool
    {
        return str_starts_with($this->name, 'Guest ');
    }

    /**
     * Check apakah participant adalah registered user
     */
    public function isRegistered(): bool
    {
        return !$this->isGuest();
    }

    /**
     * Get participant status (online/offline)
     */
    public function getStatusAttribute(): string
    {
        return $this->is_online ? 'online' : 'offline';
    }

    /**
     * Get participant type (guest/registered)
     */
    public function getTypeAttribute(): string
    {
        return $this->isGuest() ? 'guest' : 'registered';
    }

    /**
     * Get formatted last seen time
     */
    public function getLastSeenFormattedAttribute(): string
    {
        if (!$this->last_seen) {
            return 'Never';
        }

        $diffInMinutes = now()->diffInMinutes($this->last_seen);
        
        if ($diffInMinutes < 1) {
            return 'Just now';
        } elseif ($diffInMinutes < 60) {
            return $diffInMinutes . ' minutes ago';
        } elseif ($diffInMinutes < 1440) { // 24 hours
            $hours = floor($diffInMinutes / 60);
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
        } else {
            return $this->last_seen->format('M j, Y');
        }
    }

    /**
     * Get participant avatar URL or generate default
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        // Generate default avatar berdasarkan nama
        $name = urlencode($this->name);
        $backgroundColor = $this->generateAvatarColor();
        
        return "https://ui-avatars.com/api/?name={$name}&background={$backgroundColor}&color=ffffff&size=128&font-size=0.5";
    }

    /**
     * Generate warna avatar berdasarkan nama
     */
    private function generateAvatarColor(): string
    {
        $colors = [
            'FF6B6B', // Red
            '4ECDC4', // Teal
            '45B7D1', // Blue
            '96CEB4', // Green
            'FFEAA7', // Yellow
            'DDA0DD', // Plum
            'FFB347', // Orange
            '87CEEB', // Sky Blue
            'F0A3FF', // Pink
            'B19CD9'  // Purple
        ];

        $index = abs(crc32($this->name)) % count($colors);
        return $colors[$index];
    }

    /**
     * Boot method untuk auto-set joined_at
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($participant) {
            if (!$participant->joined_at) {
                $participant->joined_at = now();
            }
        });
    }

    /**
     * Get total messages count untuk participant ini
     */
    public function getTotalMessagesAttribute(): int
    {
        return $this->messages()->count();
    }

    /**
     * Get messages count hari ini
     */
    public function getTodayMessagesAttribute(): int
    {
        return $this->messages()
            ->whereDate('created_at', today())
            ->count();
    }

    /**
     * Check apakah participant aktif (online dalam 5 menit terakhir)
     */
    public function isActive(): bool
    {
        if (!$this->last_seen) {
            return false;
        }

        return $this->last_seen->diffInMinutes(now()) <= 5;
    }

    /**
     * Update nama participant (khusus untuk guest)
     */
    public function updateName(string $newName): bool
    {
        // Validasi nama tidak boleh kosong dan tidak boleh sama dengan yang sudah ada
        if (empty(trim($newName))) {
            return false;
        }

        // Check apakah nama sudah digunakan participant lain di event yang sama
        $existingParticipant = static::where('event_id', $this->event_id)
            ->where('name', $newName)
            ->where('id', '!=', $this->id)
            ->exists();

        if ($existingParticipant) {
            return false;
        }

        return $this->update(['name' => $newName]);
    }
}
