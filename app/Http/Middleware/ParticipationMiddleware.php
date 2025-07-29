<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Participant;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParticipationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $participantId = session('participant_id');
        $eventId = session('event_id');

        if (!$participantId || !$eventId) {
            return redirect()->route('join.form')
                ->with('error', 'Silakan masukkan nama untuk bergabung.');
        }

        $participant = Participant::find($participantId);

        if (!$participant || $participant->event_id != $eventId) {
            return redirect()->route('join.form')
                ->with('error', 'Silakan masukkan nama untuk bergabung.');
        }

        // Update participant status
        $participant->update([
            'is_online' => true,
            'last_seen' => now()
        ]);

        // Share participant data with views
        view()->share('currentParticipant', $participant);

        return $next($request);
    }
}
