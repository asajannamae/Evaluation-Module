<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $query = Evaluation::query()
            ->whereNotNull('decision')
            ->orderByDesc('result_date');

        if ($request->filled('q')) {
            $q = '%'.$request->string('q').'%';
            $query->where(function ($sub) use ($q) {
                $sub->where('target', 'like', $q)
                    ->orWhere('department', 'like', $q);
            });
        }

        $rows = $query->limit(200)->get()->map(function (Evaluation $e) {
            $authors = is_array($e->authors) ? implode(', ', $e->authors) : '';

            $max = (int) ($e->max_score ?: 100);
            $agg = $e->aggregate_score;
            $pct = $e->aggregate_percent;

            $tone = match (true) {
                str_contains((string) $e->decision, 'Distinction') => 'teal',
                str_contains((string) $e->decision, 'Conditional') => 'orange',
                default => 'green',
            };

            $scoreStr = $agg !== null
                ? rtrim(rtrim(number_format((float) $agg, 1, '.', ''), '0'), '.').' / '.$max
                : '—';

            return [
                'id' => (string) $e->id,
                'title' => $e->target,
                'authors' => $authors,
                'department' => $e->department ?? '',
                'stage' => $e->type,
                'date' => $e->result_date?->format('M j, Y') ?? '',
                'score' => $scoreStr,
                'pct' => $pct !== null ? number_format((float) $pct, 1, '.', '').'%' : '',
                'status' => (string) $e->decision,
                'status_tone' => $tone,
            ];
        });

        return response()->json(['data' => $rows]);
    }
}
