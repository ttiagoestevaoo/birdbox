<?php

namespace App;

use App\Project;
use App\RecordActivity;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use RecordActivity;
    public $fillable = ['body','completed'];

    public $touches = ['project'];
    
    
    public function path()
    {
        return $this->project->path() . "/tasks/" . $this->id;
    }
    protected static $recordableEvents = ['created','deleted'];

    public function complete()
    {
        $this->recordActivity("completed_task");
        $this->update(['completed'=>true]);
    }

            
        
    public function incomplete()
    {
        $this->recordActivity("uncompleted_task");
        $this->update(['completed'=>false]);
    }

    public function project()
    {
        return $this-> belongsTo(Project::class);
    }

   
    
}
