<?php
namespace App;

/**
 * 
 */
trait RecordActivity
{
    public $oldAttributtes =[]; 
    public function activityChanges($description)
        {
            if($this->wasChanged()){
                return [
                    'before' => array_diff($this->oldAttributtes,$this->getAttributes()),
                    'after' => $this->getChanges()
                ];
            }
        } 

    public static function bootRecordActivity()
    {
        static::updating(function ($model){
            $model->oldAttributtes = $model->getOriginal();
        });

        
        
        
        foreach (self::recordableEvents() as $event) {
            static::$event(function($model) use ($event){
                
                $event = "{$event}_" . strtolower(class_basename($model));
                
                $model -> recordActivity($event);
            });
        }
    }
    public static function recordableEvents()
    {
        if(isset(static::$recordableEvents)){
            return static::$recordableEvents;
        }
        return ['created','updated'];
    }
   public function activity()
    {
       return $this->morphMany(Activity::class, 'subject')->latest();
    } 

    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' => $this -> activityChanges($description),
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id
        ]);
    }

    
}
