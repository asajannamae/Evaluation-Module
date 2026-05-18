<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Evaluation;
use App\Models\Rubric;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        // For a panelist, we filter bookings where they are in the assigned_panelists array
        // or where the booking is for their department if we want to show all invitations.
        // For this system, we'll assume the panelist is specifically assigned.
        
        $bookings = Booking::with('evaluation')
            ->where(function ($query) use ($user) {
                $query->whereJsonContains('assigned_panelists', ['id' => (string)$user->username])
                      ->orWhereJsonContains('assigned_panelists', ['id' => $user->id])
                      ->orWhereJsonContains('assigned_panelists', ['name' => $user->name]);
            })
            ->get();

        return response()->json($bookings);
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'status' => ['required', 'string', 'in:approved,declined'],
            'decline_reason' => ['nullable', 'string'],
        ]);

        $booking->update([
            'status' => $data['status'],
            'decline_reason' => $data['decline_reason'] ?? $booking->decline_reason,
        ]);

        if ($data['status'] === 'approved') {
            // Create an evaluation record if it doesn't exist
            $existing = Evaluation::where('target', $booking->research_title)
                ->where('type', $booking->defense_type)
                ->first();

            if (!$existing) {
                // Find a suitable rubric
                $rubric = Rubric::where('stage', strtolower($booking->defense_type))
                    ->orWhere('title', 'LIKE', '%' . $booking->defense_type . '%')
                    ->first();

                Evaluation::create([
                    'booking_id' => $booking->id,
                    'rubric_id' => $rubric?->id,
                    'target' => $booking->research_title,
                    'type' => $booking->defense_type,
                    'defense_stage' => strtolower($booking->defense_type),
                    'authors' => $booking->members,
                    'department' => $booking->department,
                    'status' => 'pending',
                    'due_date' => $booking->requested_date,
                ]);
            }
        }

        return response()->json($booking);
    }
}
