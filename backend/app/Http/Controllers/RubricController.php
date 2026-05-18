<?php

namespace App\Http\Controllers;

use App\Models\Rubric;

class RubricController extends Controller
{
    public function index()
    {
        $rows = Rubric::query()
            ->with('criteria')
            ->orderBy('stage')
            ->get()
            ->map(function (Rubric $rubric) {
                return [
                    'id' => $rubric->id,
                    'name' => $rubric->title,
                    'stage' => $rubric->stage,
                    'criteria' => $rubric->criteria->map(function ($c) {
                        return [
                            'id' => $c->criterion_key,
                            'name' => $c->name,
                            'maxScore' => (int) $c->max_points,
                            'description' => (string) ($c->description ?? ''),
                        ];
                    })->values()->all(),
                ];
            });

        return response()->json(['data' => $rows]);
    }
}
