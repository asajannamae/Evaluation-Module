<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Evaluation;
use App\Models\Rubric;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $rubric = Rubric::query()->first();
        $rubricId = $rubric ? $rubric->id : null;

        $b1 = Booking::create([
            'research_title' => 'AI-Powered Learning Management System',
            'members' => ['John Doe', 'Jane Smith', 'Bob Johnson'],
            'adviser_name' => 'Dr. Maria Santos',
            'department' => 'SCIS',
            'requested_date' => '2026-05-20',
            'requested_time' => '10:00 AM',
            'venue' => 'JH32',
            'defense_type' => 'Title Defense',
            'status' => 'approved',
            'assigned_panelists' => [
                ['id' => '23-181818', 'name' => 'Dr. Jeremy Quintela']
            ]
        ]);

        Evaluation::create([
            'booking_id' => $b1->id,
            'rubric_id' => $rubricId,
            'target' => $b1->research_title,
            'type' => $b1->defense_type,
            'defense_stage' => 'proposal',
            'authors' => $b1->members,
            'department' => $b1->department,
            'status' => 'pending',
            'due_date' => $b1->requested_date,
            'max_score' => 100,
        ]);

        $b2 = Booking::create([
            'research_title' => 'IoT Campus Monitoring System',
            'members' => ['Chris Tan', 'Jamie Park'],
            'adviser_name' => 'Prof. Alan Lee',
            'department' => 'SCIS',
            'requested_date' => '2026-05-15',
            'requested_time' => '11:00 AM',
            'venue' => 'JH32',
            'defense_type' => 'Proposal Defense',
            'status' => 'approved',
            'assigned_panelists' => [
                ['id' => '23-181818', 'name' => 'Dr. Jeremy Quintela']
            ]
        ]);

        Evaluation::create([
            'booking_id' => $b2->id,
            'rubric_id' => $rubricId,
            'target' => $b2->research_title,
            'type' => $b2->defense_type,
            'defense_stage' => 'proposal',
            'authors' => $b2->members,
            'department' => $b2->department,
            'status' => 'pending',
            'due_date' => $b2->requested_date,
            'max_score' => 100,
        ]);
    }
}
