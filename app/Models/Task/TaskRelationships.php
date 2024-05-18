<?php

namespace App\Models\Task;

use App\Models\Project\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TaskRelationships
{
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
