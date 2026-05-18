<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index(Request $request)
    {
        $query = Evaluation::query()->orderByDesc('due_date');

        return $query->paginate((int) $request->query('per_page', 50));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'target' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:120'],
            'status' => ['required', 'string', 'max:60'],
            'due_date' => ['required', 'date'],
        ]);

        $evaluation = Evaluation::query()->create($data);

        return response()->json($evaluation, 201);
    }

    public function update(Request $request, Evaluation $evaluation)
    {
        $data = $request->validate([
            'target' => ['sometimes', 'string', 'max:255'],
            'type' => ['sometimes', 'string', 'max:120'],
            'status' => ['sometimes', 'string', 'max:60'],
            'due_date' => ['sometimes', 'date'],
        ]);

        $evaluation->fill($data);
        $evaluation->save();

        return response()->json($evaluation);
    }
}
