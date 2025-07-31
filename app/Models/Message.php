<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'attachment_url'
    ];

    protected $casts = [
        'created_at' => 'datetime',
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
                    'alt' => 'Shared Image'
                ];
            
            case 'location':
                $locationData = $this->getLocationData();
                return [
                    'type' => 'location',
                    'data' => $locationData,
                    'name' => $locationData['name'] ?? 'Shared Location',
                    'coordinates' => $locationData['lat'] . ', ' . $locationData['lng'],
                    'url' => $locationData['url'] ?? '#'
                ];
            
            default:
                return null;
        }
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
     * Boot method untuk handle file deletion
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($message) {
            $message->deleteAttachmentFile();
        });
    }
}
