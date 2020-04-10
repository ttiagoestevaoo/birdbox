@if(count($activity->changes['after']) == 2)
     updated the {{key($activity->changes['after'])}}
@else
     updated the project
@endif