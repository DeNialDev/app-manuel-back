<?php

namespace App\Models\Project;

trait ProjectAccessors
{
    public function getTasksOwnAttribute()
    {
        return $this->tasks;
    }
}
