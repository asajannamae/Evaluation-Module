<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_title',
        'members',
        'adviser_name',
        'department',
        'requested_date',
        'requested_time',
        'venue',
        'defense_type',
        'status',
        'assigned_panelists',
        'decline_reason',
    ];

    protected $casts = [
        'members' => 'array',
        'assigned_panelists' => 'array',
        'requested_date' => 'date',
    ];

    public function evaluation()
    {
        return $this->hasOne(Evaluation::class);
    }
}
