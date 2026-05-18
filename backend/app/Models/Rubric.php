<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rubric extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'stage',
    ];

    /**
     * @return HasMany<RubricCriterion, $this>
     */
    public function criteria(): HasMany
    {
        return $this->hasMany(RubricCriterion::class)->orderBy('sort_order');
    }
}
