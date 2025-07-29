<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventSchedule;
use App\Models\EventBank;
use App\Models\Media;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample event
        $event = Event::create([
            'title' => 'Wedding Celebration - Ahmad & Siti',
            'description' => 'Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu kepada kedua mempelai.',
            'groom_name' => 'Ahmad',
            'bride_name' => 'Siti',
            'event_date' => now()->addDays(30),
            'location' => 'Gedung Serbaguna Sukahati, Jl. Raya Sukahati No. 123, Cibinong, Bogor',
            'dress_code_image' => 'events/dress-code.jpg',
            'invitation_code' => 'AHMAD-SITI-2024',
            'is_active' => true
        ]);

        // Create schedules
        $schedules = [
            [
                'start_time' => '16:00',
                'end_time' => '16:30',
                'title' => 'Sambutan Orang Tua',
                'description' => 'Penyambutan dari kedua orang tua mempelai',
                'color' => '#FF6B6B',
                'order' => 1
            ],
            [
                'start_time' => '16:30',
                'end_time' => '18:45',
                'title' => 'Pembacaan Mantra',
                'description' => 'Rangkaian doa dan doa dari dua keluarga',
                'color' => '#4ECDC4',
                'order' => 2
            ],
            [
                'start_time' => '18:45',
                'end_time' => '19:20',
                'title' => 'Penyerahan Mahar',
                'description' => 'Penyerahan mahar dari mempelai pria kepada mempelai wanita',
                'color' => '#45B7D1',
                'order' => 3
            ],
            [
                'start_time' => '19:20',
                'end_time' => '19:50',
                'title' => 'Sholat Maghrib Berjamaah',
                'description' => 'Melaksanakan sholat maghrib berjamaah',
                'color' => '#96CEB4',
                'order' => 4
            ],
            [
                'start_time' => '19:50',
                'end_time' => '20:00',
                'title' => 'Ucapan Selamat Dari Tamu',
                'description' => 'Sesi foto bersama dan ucapan selamat dari para tamu',
                'color' => '#FFEAA7',
                'order' => 5
            ],
            [
                'start_time' => '20:00',
                'end_time' => '21:30',
                'title' => 'Resepsi Pernikahan',
                'description' => 'Makan bersama dan hiburan untuk para tamu undangan',
                'color' => '#DDA0DD',
                'order' => 6
            ]
        ];

        foreach ($schedules as $schedule) {
            EventSchedule::create(array_merge($schedule, ['event_id' => $event->id]));
        }

        // Create bank information
        EventBank::create([
            'event_id' => $event->id,
            'bank_name' => 'BCA',
            'account_number' => '1234567890',
            'account_holder' => 'Ahmad Siti Wedding',
            'bank_logo' => 'banks/bca-logo.png'
        ]);

        // Create sample media - sesuai dengan nama file yang ada di screenshot
        $mediaItems = [
            [
                'title' => 'Pre-Wedding Video',
                'description' => 'Video romantis perjalanan cinta Ahmad & Siti',
                'file_path' => 'events/videos/Pre-Wedding.mp4', // Sesuai nama file di screenshot
                'type' => 'video' // Kembali ke 'video'
            ],
            [
                'title' => 'Foto Prewedding 1',
                'description' => 'Foto prewedding di taman',
                'file_path' => 'events/images/Foto Prewedding 1.jpeg', // Sesuai nama file di screenshot
                'type' => 'image' // Kembali ke 'image'
            ],
            [
                'title' => 'Foto Prewedding 2',
                'description' => 'Foto prewedding di pantai',
                'file_path' => 'events/images/Foto Prewedding 2.jpeg',
                'type' => 'image'
            ],
            [
                'title' => 'Foto Prewedding 3',
                'description' => 'Foto prewedding di studio',
                'file_path' => 'events/images/Foto Prewedding 3.jpeg',
                'type' => 'image'
            ],
            [
                'title' => 'Foto Prewedding 4',
                'description' => 'Foto prewedding outdoor',
                'file_path' => 'events/images/Foto Prewedding 4.jpeg',
                'type' => 'image'
            ],
            [
                'title' => 'Foto Prewedding 5',
                'description' => 'Foto prewedding romantis',
                'file_path' => 'events/images/Foto Prewedding 5.jpeg',
                'type' => 'image'
            ]
        ];

        foreach ($mediaItems as $media) {
            Media::create(array_merge($media, ['event_id' => $event->id]));
        }
    }
}
