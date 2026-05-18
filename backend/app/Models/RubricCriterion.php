<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RubricCriterion extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'rubric_id',
        'criterion_key',
        'name',
        'max_points',
        'description',
        'sort_order',
    ];

    /**
     * @return BelongsTo<Rubric, $this>
     */
    public function rubric(): BelongsTo
    {
        return $this->belongsTo(Rubric::class);
    }
}
