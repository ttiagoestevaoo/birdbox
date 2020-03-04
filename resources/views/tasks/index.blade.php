@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 w-full py-4">    
        <h1 class="mr-auto">My tasks</h1>
        
    </header>

    <main class="flex flex-wrap justify-start sm:-mx-3 mx-3 ">
        @forelse($tasks as $task)
            <div class="w-full sm:w-1/2  lg:w-1/3 xl:w-1/4 px-3 pb-6 " >
                <p>{{$task->body}}</p>    
            </div>
        @empty
            <p>No tasks yet.</p>
        @endforelse
    </main>
            

    
   
@endsection