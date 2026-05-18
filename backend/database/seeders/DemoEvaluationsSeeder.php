<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use App\Models\Rubric;
use Illuminate\Database\Seeder;

class DemoEvaluationsSeeder extends Seeder
{
    public function run(): void
    {
        $rubricId = Rubric::query()->where('stage', 'proposal')->value('id');

        $rows = [
            [
                'target' => 'AI-Powered Learning Management System',
                'type' => 'Title Defense',
                'defense_stage' => 'proposal',
                'status' => 'pending',
                'due_date' => '2024-12-20',
                'rubric_id' => $rubricId,
                'authors' => ['John Doe', 'Jane Smith', 'Bob Johnson'],
                'department' => 'School of Computer and Information Sciences',
                'max_score' => 100,
                'aggregate_score' => 85,
                'aggregate_percent' => 85.0,
                'decision' => 'Passed',
                'result_date' => '2024-02-15',
            ],
            [
                'target' => 'Blockchain-Based Credential Verification',
                'type' => 'Final Defense',
                'defense_stage' => 'proposal',
                'status' => 'completed',
                'due_date' => '2024-11-05',
                'rubric_id' => $rubricId,
                'authors' => ['Alex Lee', 'Sam Rivera'],
                'department' => 'School of Computer and Information Sciences',
                'max_score' => 100,
                'aggregate_score' => 92,
                'aggregate_percent' => 92.0,
                'decision' => 'Passed with Distinction',
                'result_date' => '2024-03-02',
            ],
            [
                'target' => 'IoT Smart Campus Monitoring',
                'type' => 'Review Defense',
                'defense_stage' => 'proposal',
                'status' => 'pending',
                'due_date' => '2025-01-10',
                'rubric_id' => $rubricId,
                'authors' => ['Chris Tan'],
                'department' => 'School of Computer and Information Sciences',
                'max_score' => 100,
                'aggregate_score' => 74,
                'aggregate_percent' => 74.0,
                'decision' => 'Conditional Pass',
                'result_date' => '2024-01-10',
            ],
            [
                'target' => 'Adaptive Assessment Using Machine Learning',
                'type' => 'Title Defense',
                'defense_stage' => 'proposal',
                'status' => 'pending',
                'due_date' => '2025-02-02',
                'rubric_id' => $rubricId,
                'authors' => ['Jamie Park', 'Lee Wong'],
                'department' => 'School of Computer and Information Sciences',
                'max_score' => 100,
                'aggregate_score' => null,
                'aggregate_percent' => null,
                'decision' => null,
                'result_date' => null,
            ],
        ];

        foreach ($rows as $row) {
            Evaluation::query()->updateOrCreate(
                ['target' => $row['target']],
                $row
            );
        }
    }
}
