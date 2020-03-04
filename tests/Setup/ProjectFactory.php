<?php

namespace Tests\Setup;

use App\Project;
use App\Task;
use App\User;

class ProjectFactory
{
    protected $tasksCount = 0;

    public function create()
    {
        $project = factory(Project::class)->create([
            'user_id' => $this->user ?? factory(User::class)
        ]);

        factory(Task::class, $this->tasksCount)->create([
            'project_id' => $project->id,
            'user_id' => $project->user
        ]);

        return $project;
    }

    public function withTasks(Int $count)
    {
        $this->tasksCount = $count;

        return $this;
    }

    public function ownedBy ($user)
    {
        $this->user = $user;

        return $this;
    }


}
