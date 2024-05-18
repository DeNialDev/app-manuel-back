<?php

namespace App\Models\Project;

use App\Models\Task\Task;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ProjectRelationships
{
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
