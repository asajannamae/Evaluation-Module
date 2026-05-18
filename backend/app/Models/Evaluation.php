<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evaluation extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'rubric_id',
        'booking_id',
        'target',
        'type',
        'defense_stage',
        'authors',
        'department',
        'max_score',
        'aggregate_score',
        'aggregate_percent',
        'decision',
        'result_date',
        'status',
        'due_date',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'result_date' => 'date',
            'authors' => 'array',
            'aggregate_score' => 'decimal:2',
            'aggregate_percent' => 'decimal:2',
        ];
    }

    /**
     * @return BelongsTo<Rubric, $this>
     */
    public function rubric(): BelongsTo
    {
        return $this->belongsTo(Rubric::class);
    }

    /**
     * @return HasMany<PanelistRubricSubmission, $this>
     */
    public function panelistSubmissions(): HasMany
    {
        return $this->hasMany(PanelistRubricSubmission::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
