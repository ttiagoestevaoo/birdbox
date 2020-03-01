<?php

namespace App\Observers;

use App\Project;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
       $this->recordActivity($project,'created');
    }

    /**
     * Handle the project "updated" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
       $this->recordActivity($project,'updated');
    }
    public function recordActivity(Project $project,$type)
    {
        \App\Activity::create([
        'project_id' => $project->id,
        'description' => $type
    ]); //# code...
    }

}
