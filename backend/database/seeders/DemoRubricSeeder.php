<?php

namespace Database\Seeders;

use App\Models\Rubric;
use App\Models\RubricCriterion;
use Illuminate\Database\Seeder;

class DemoRubricSeeder extends Seeder
{
    public function run(): void
    {
        $rubric = Rubric::query()->updateOrCreate(
            ['stage' => 'proposal'],
            ['title' => 'PROJECT DOCUMENTATION AND MANUSCRIPT']
        );

        $criteria = [
            [
                'criterion_key' => 'c1',
                'name' => 'Project Context',
                'max_points' => 10,
                'description' => 'Clearly establishes the research problem, significance, and scope within the academic and practical context.',
                'sort_order' => 1,
            ],
            [
                'criterion_key' => 'c2',
                'name' => 'Objectives and Questions',
                'max_points' => 10,
                'description' => 'States measurable objectives and well-formed research questions aligned with the problem.',
                'sort_order' => 2,
            ],
        ];

        foreach ($criteria as $row) {
            RubricCriterion::query()->updateOrCreate(
                [
                    'rubric_id' => $rubric->id,
                    'criterion_key' => $row['criterion_key'],
                ],
                [
                    'rubric_id' => $rubric->id,
                    'name' => $row['name'],
                    'max_points' => $row['max_points'],
                    'description' => $row['description'],
                    'sort_order' => $row['sort_order'],
                ]
            );
        }
    }
}
