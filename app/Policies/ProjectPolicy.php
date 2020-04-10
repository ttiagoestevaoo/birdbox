<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function userProject(User $user, Project $project)
    {
        return $user->is($project->user) || $project->members->contains($user);
    }

    public function manage(User $user, Project $project)
    {
        return $user->is($project->user);
    }
}
