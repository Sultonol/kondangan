<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Event;
use App\Models\EventSchedule;
use App\Models\EventBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function uploadMedia(Request $request, Event $event)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi,webm|max:50000', // Added webm, emphasized jpeg
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video,document'
        ]);

        // Determine folder based on type
        $folder = match($request->type) {
            'image' => 'events/images',
            'video' => 'events/videos',
            'document' => 'events/documents',
            default => 'events/misc'
        };

        // Store file
        $path = $request->file('file')->store($folder, 'public');

        // Save to database
        $media = Media::create([
            'event_id' => $event->id,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'type' => $request->type
        ]);

        return response()->json([
            'success' => true, 
            'media' => $media,
            'url' => $media->url
        ]);
    }

    public function uploadDressCode(Request $request, Event $event)
    {
        $request->validate([
            'dress_code_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5000' // Added webp, emphasized jpeg
        ]);

        // Delete old image if exists
        if ($event->dress_code_image) {
            Storage::disk('public')->delete($event->dress_code_image);
        }

        // Store new image
        $path = $request->file('dress_code_image')->store('events', 'public');

        // Update event
        $event->update(['dress_code_image' => $path]);

        return response()->json([
            'success' => true, 
            'path' => $path,
            'url' => asset('storage/' . $path)
        ]);
    }

    public function addSchedule(Request $request, Event $event)
    {
        $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'order' => 'nullable|integer|min:0'
        ]);

        $schedule = EventSchedule::create([
            'event_id' => $event->id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'title' => $request->title,
            'description' => $request->description,
            'color' => $request->color ?? '#3B82F6',
            'order' => $request->order ?? 0
        ]);

        return response()->json([
            'success' => true,
            'schedule' => $schedule
        ]);
    }

    public function addBank(Request $request, Event $event)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'account_holder' => 'required|string|max:255',
            'bank_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2000' // 2MB max
        ]);

        $bankData = [
            'event_id' => $event->id,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_holder' => $request->account_holder,
        ];

        // Handle bank logo upload
        if ($request->hasFile('bank_logo')) {
            $path = $request->file('bank_logo')->store('banks', 'public');
            $bankData['bank_logo'] = $path;
        }

        $bank = EventBank::create($bankData);

        return response()->json([
            'success' => true,
            'bank' => $bank,
            'logo_url' => $bank->bank_logo_url
        ]);
    }
}
