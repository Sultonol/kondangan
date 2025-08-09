<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'participant_id',
        'sender_name',
        'message',
        'type',
        'file_path',
        'attachment_type',
        'attachment_data',
        'attachment_url',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship dengan Event
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Relationship dengan Participant
     */
    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

    /**
     * Get sender name (prioritas sender_name, fallback ke participant name)
     */
    public function getSenderNameAttribute()
    {
        return $this->attributes['sender_name'] ?? $this->participant?->name ?? 'Unknown';
    }

    /**
     * Override untuk selalu return WIB timezone untuk created_at
     */
    public function getCreatedAtAttribute($value)
    {
        return $this->asDateTime($value)->setTimezone('Asia/Jakarta');
    }

    /**
     * Override untuk selalu return WIB timezone untuk updated_at
     */
    public function getUpdatedAtAttribute($value)
    {
        return $this->asDateTime($value)->setTimezone('Asia/Jakarta');
    }

    /**
     * Get formatted time in WIB
     */
    public function getFormattedTimeAttribute(): string
    {
        return $this->created_at->format('H:i');
    }

    /**
     * Get formatted date time in WIB
     */
    public function getFormattedDateTimeAttribute(): string
    {
        return $this->created_at->format('d M Y, H:i');
    }

    /**
     * Get full formatted date time with WIB suffix
     */
    public function getFullFormattedTimeAttribute(): string
    {
        return $this->created_at->format('d M Y, H:i') . ' WIB';
    }

    /**
     * Check if message has attachment
     */
    public function hasAttachment(): bool
    {
        return !empty($this->attachment_type);
    }

    /**
     * Check if attachment is image
     */
    public function isImageAttachment(): bool
    {
        return $this->attachment_type === 'image';
    }

    /**
     * Check if attachment is location
     */
    public function isLocationAttachment(): bool
    {
        return $this->attachment_type === 'location';
    }

    /**
     * Get location data as array
     */
    public function getLocationData(): ?array
    {
        if ($this->isLocationAttachment() && $this->attachment_data) {
            return json_decode($this->attachment_data, true);
        }
        return null;
    }

    /**
     * Get image URL
     */
    public function getImageUrl(): ?string
    {
        if ($this->isImageAttachment()) {
            return $this->attachment_url ?: asset('storage/' . $this->attachment_data);
        }
        return null;
    }

    /**
     * Get attachment preview for display
     */
    public function getAttachmentPreview(): ?array
    {
        if (!$this->hasAttachment()) {
            return null;
        }

        switch ($this->attachment_type) {
            case 'image':
                return [
                    'type' => 'image',
                    'url' => $this->getImageUrl(),
                    'alt' => 'Shared Image',
                    'size' => $this->getImageFileSize(),
                    'exists' => $this->imageExists()
                ];
                
            case 'location':
                $locationData = $this->getLocationData();
                return [
                    'type' => 'location',
                    'data' => $locationData,
                    'name' => $locationData['name'] ?? 'Shared Location',
                    'coordinates' => ($locationData['lat'] ?? '') . ', ' . ($locationData['lng'] ?? ''),
                    'url' => $locationData['url'] ?? '#',
                    'is_wedding_venue' => $locationData['is_wedding_venue'] ?? false,
                    'map_url' => $this->getLocationMapUrl($locationData)
                ];
                
            default:
                return null;
        }
    }

    /**
     * Get location map URL for embedding
     */
    private function getLocationMapUrl(?array $locationData): string
    {
        if (!$locationData) {
            return '';
        }

        if ($locationData['is_wedding_venue'] ?? false) {
            return 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.192079040854!2d106.92321707503716!3d-6.201992893774889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698cd0b04c8f2b%3A0x673c6a4d7d3c5f4!2sMasjid%20Jami%20Al-Utsmani!5e0!3m2!1sen!2sid!4v1753913917430!5m2!1sen!2sid';
        }

        $lat = $locationData['lat'] ?? -6.2088;
        $lng = $locationData['lng'] ?? 106.8456;
        return "https://maps.google.com/maps?q={$lat},{$lng}&z=15&output=embed";
    }

    /**
     * Scope untuk messages dengan attachment
     */
    public function scopeWithAttachment($query)
    {
        return $query->whereNotNull('attachment_type');
    }

    /**
     * Scope untuk messages dengan image attachment
     */
    public function scopeWithImages($query)
    {
        return $query->where('attachment_type', 'image');
    }

    /**
     * Scope untuk messages dengan location attachment
     */
    public function scopeWithLocation($query)
    {
        return $query->where('attachment_type', 'location');
    }

    /**
     * Scope untuk messages dalam rentang waktu tertentu (WIB)
     */
    public function scopeInTimeRange($query, $startTime, $endTime)
    {
        return $query->whereBetween('created_at', [
            Carbon::parse($startTime, 'Asia/Jakarta')->utc(),
            Carbon::parse($endTime, 'Asia/Jakarta')->utc()
        ]);
    }

    /**
     * Scope untuk messages hari ini (WIB)
     */
    public function scopeToday($query)
    {
        $today = Carbon::now('Asia/Jakarta');
        return $query->whereDate('created_at', $today->toDateString());
    }

    /**
     * Scope untuk messages kemarin (WIB)
     */
    public function scopeYesterday($query)
    {
        $yesterday = Carbon::yesterday('Asia/Jakarta');
        return $query->whereDate('created_at', $yesterday->toDateString());
    }

    /**
     * Get file size if it's an image attachment
     */
    public function getImageFileSize(): ?string
    {
        if (!$this->isImageAttachment() || !$this->attachment_data) {
            return null;
        }

        $filePath = storage_path('app/public/' . $this->attachment_data);
        
        if (file_exists($filePath)) {
            $bytes = filesize($filePath);
            $units = ['B', 'KB', 'MB', 'GB'];
            
            for ($i = 0; $bytes > 1024; $i++) {
                $bytes /= 1024;
            }
            
            return round($bytes, 2) . ' ' . $units[$i];
        }
        
        return null;
    }

    /**
     * Check if image file exists
     */
    public function imageExists(): bool
    {
        if (!$this->isImageAttachment() || !$this->attachment_data) {
            return false;
        }

        return file_exists(storage_path('app/public/' . $this->attachment_data));
    }

    /**
     * Delete attachment file
     */
    public function deleteAttachmentFile(): bool
    {
        if (!$this->hasAttachment()) {
            return true;
        }

        if ($this->isImageAttachment() && $this->attachment_data) {
            $filePath = storage_path('app/public/' . $this->attachment_data);
            if (file_exists($filePath)) {
                return unlink($filePath);
            }
        }

        return true;
    }

    /**
     * Get message content for search/display
     */
    public function getContentAttribute(): string
    {
        if (!empty($this->message)) {
            return $this->message;
        }

        if ($this->isImageAttachment()) {
            return '📷 Shared an image';
        }

        if ($this->isLocationAttachment()) {
            $locationData = $this->getLocationData();
            $locationName = $locationData['name'] ?? 'location';
            return "📍 Shared {$locationName}";
        }

        return 'Sent an attachment';
    }

    /**
     * Get message summary for notifications
     */
    public function getSummaryAttribute(): string
    {
        $senderName = $this->sender_name ?? 'Someone';
        
        if (!empty($this->message)) {
            $preview = strlen($this->message) > 50 
                ? substr($this->message, 0, 50) . '...' 
                : $this->message;
            return "{$senderName}: {$preview}";
        }

        return "{$senderName}: {$this->content}";
    }

    /**
     * Check if message is from today (WIB)
     */
    public function isFromToday(): bool
    {
        $today = Carbon::now('Asia/Jakarta')->startOfDay();
        return $this->created_at->gte($today);
    }

    /**
     * Check if message is from yesterday (WIB)
     */
    public function isFromYesterday(): bool
    {
        $yesterday = Carbon::yesterday('Asia/Jakarta');
        return $this->created_at->isSameDay($yesterday);
    }

    /**
     * Get relative time (e.g., "2 hours ago") in WIB context
     */
    public function getRelativeTimeAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Get time ago in Indonesian
     */
    public function getTimeAgoIndonesianAttribute(): string
    {
        $diff = $this->created_at->diffInMinutes(Carbon::now('Asia/Jakarta'));
        
        if ($diff < 1) {
            return 'Baru saja';
        } elseif ($diff < 60) {
            return $diff . ' menit yang lalu';
        } elseif ($diff < 1440) { // 24 hours
            $hours = floor($diff / 60);
            return $hours . ' jam yang lalu';
        } elseif ($diff < 10080) { // 7 days
            $days = floor($diff / 1440);
            return $days . ' hari yang lalu';
        } else {
            return $this->created_at->format('d M Y');
        }
    }

    /**
     * Convert message to array for API response
     */
    public function toApiArray(): array
    {
        return [
            'id' => $this->id,
            'message' => $this->message,
            'sender_name' => $this->sender_name,
            'attachment_type' => $this->attachment_type,
            'attachment_url' => $this->attachment_url,
            'attachment_data' => $this->attachment_data,
            'location_data' => $this->getLocationData(),
            'attachment_preview' => $this->getAttachmentPreview(),
            'content' => $this->content,
            'summary' => $this->summary,
            'created_at' => $this->created_at->format('H:i'),
            'created_at_full' => $this->created_at->format('Y-m-d H:i:s'),
            'formatted_time' => $this->formatted_time,
            'formatted_date_time' => $this->formatted_date_time,
            'full_formatted_time' => $this->full_formatted_time,
            'relative_time' => $this->relative_time,
            'time_ago_indonesian' => $this->time_ago_indonesian,
            'is_from_today' => $this->isFromToday(),
            'is_from_yesterday' => $this->isFromYesterday(),
            'timezone' => 'WIB',
            'participant' => [
                'id' => $this->participant->id ?? null,
                'name' => $this->participant->name ?? null,
                'avatar' => $this->participant->avatar ?? null
            ]
        ];
    }

    /**
     * Boot method untuk handle file deletion dan timezone
     */
    protected static function boot()
    {
        parent::boot();

        // Handle file deletion saat message dihapus
        static::deleting(function ($message) {
            $message->deleteAttachmentFile();
        });

        // Set timezone WIB saat creating message
        static::creating(function ($message) {
            if (!$message->created_at) {
                $message->created_at = Carbon::now('Asia/Jakarta');
            }
        if (!$message->updated_at) {
                $message->updated_at = Carbon::now('Asia/Jakarta');
            }
        });

        // Set timezone WIB saat updating message
        static::updating(function ($message) {
            $message->updated_at = Carbon::now('Asia/Jakarta');
        });
    }
}
