<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\PanelistRubricSubmission;
use App\Models\Rubric;
use Illuminate\Http\Request;

class EvaluationPanelController extends Controller
{
    public function rubricBundle(Evaluation $evaluation)
    {
        $rubric = $evaluation->rubric
            ?? Rubric::query()->where('stage', $evaluation->defense_stage)->with('criteria')->first()
            ?? Rubric::query()->with('criteria')->first();

        $submission = PanelistRubricSubmission::query()
            ->where('evaluation_id', $evaluation->id)
            ->where('user_id', auth()->id())
            ->first();

        $rubricsFormatted = [];
        if ($rubric) {
            $rubricsFormatted[] = [
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
        }

        return response()->json([
            'evaluation' => $evaluation,
            'rubrics' => $rubricsFormatted,
            'submission' => $submission ? [
                'scores' => $submission->scores,
                'comments' => $submission->comments ?? [],
                'general_comments' => $submission->general_comments,
                'status' => $submission->status,
                'total_score' => $submission->total_score,
            ] : null,
        ]);
    }

    public function upsertSubmission(Request $request, Evaluation $evaluation)
    {
        $data = $request->validate([
            'scores' => ['required', 'array'],
            'comments' => ['nullable', 'array'],
            'general_comments' => ['nullable', 'string'],
            'status' => ['required', 'string', 'in:draft,submitted'],
            'total_score' => ['nullable', 'numeric'],
        ]);

        $submission = PanelistRubricSubmission::query()->updateOrCreate(
            [
                'evaluation_id' => $evaluation->id,
                'user_id' => $request->user()->id,
            ],
            [
                'scores' => $data['scores'],
                'comments' => $data['comments'] ?? [],
                'general_comments' => $data['general_comments'] ?? null,
                'status' => $data['status'],
                'total_score' => $data['total_score'] ?? null,
                'submitted_at' => $data['status'] === 'submitted' ? now() : null,
            ]
        );

        if ($data['status'] === 'submitted') {
            $evaluation->fill(['status' => 'completed']);
            $evaluation->save();
        }

        return response()->json($submission);
    }

    public function results(Request $request)
    {
        $user = $request->user();
        
        // Return evaluations where the user was a panelist (via the associated booking)
        $evaluations = Evaluation::with(['rubric', 'panelistSubmissions'])
            ->whereHas('booking', function($query) use ($user) {
                $query->whereJsonContains('assigned_panelists', ['id' => (string)$user->username])
                      ->orWhereJsonContains('assigned_panelists', ['id' => $user->id])
                      ->orWhereJsonContains('assigned_panelists', ['name' => $user->name]);
            })
            ->get();

        return response()->json($evaluations);
    }

    public function mySubmissions(Request $request)
    {
        $user = $request->user();
        $submissions = PanelistRubricSubmission::with('evaluation')
            ->where('user_id', $user->id)
            ->get();
            
        return response()->json($submissions);
    }
}

