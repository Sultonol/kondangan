<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Media;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $event = Event::create([
            'title' => 'Wedding Celebration - Ahmad & Siti',
            'description' => 'Join us in celebrating the union of Ahmad and Siti. Your presence will make our special day even more meaningful.',
            'groom_name' => 'Ahmad Rahman',
            'bride_name' => 'Siti Nurhaliza',
            'event_date' => now()->addDays(30),
            'location' => 'Grand Ballroom, Hotel Mulia Jakarta',
            'dress_code_image' => null,
            'schedule' => [
                [
                    'time' => '14:00',
                    'title' => 'Akad Nikah',
                    'description' => 'Islamic wedding ceremony'
                ],
                [
                    'time' => '18:00',
                    'title' => 'Wedding Reception',
                    'description' => 'Dinner and celebration'
                ],
                [
                    'time' => '20:00',
                    'title' => 'Entertainment',
                    'description' => 'Live music and dancing'
                ]
            ],
            'bank_name' => 'Bank Mandiri',
            'account_number' => '1234567890',
            'account_holder' => 'Ahmad Rahman',
            'invitation_code' => 'WEDDING2024',
            'is_active' => true
        ]);

        // Create sample media
        Media::create([
            'event_id' => $event->id,
            'title' => 'Pre-wedding Photos',
            'description' => 'Beautiful moments captured before the big day',
            'file_path' => 'media/prewedding.jpg',
            'type' => 'image'
        ]);

        Media::create([
            'event_id' => $event->id,
            'title' => 'Wedding Invitation Video',
            'description' => 'Personal invitation from the couple',
            'file_path' => 'media/invitation-video.mp4',
            'type' => 'video'
        ]);
    }
}
