<?php

namespace Spatie\Health\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;

class CheckResultHistoryItem extends Model
{
    use HasFactory;

    use MassPrunable;

    public $guarded = [];

    public $casts = [
        'meta' => 'array',
        'started_failing_at' => 'timestamp',
    ];

    public function prunable()
    {
        $days = config('health.keep_history_for_days');

        return static::where('created_at', '<=', now()->subDays($days));
    }
}