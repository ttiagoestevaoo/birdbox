<?php

namespace App;

use App\Project;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $fillable = ['body','completed'];

    public $touches = ['project'];
    public function path()
    {
        return $this->project->path() . "/tasks/" . $this->id;
    }


    public function project()
    {
        return $this-> belongsTo(Project::class);
    }
}
