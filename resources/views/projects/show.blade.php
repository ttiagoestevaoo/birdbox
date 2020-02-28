@extends('layouts.app')

@section('content')

<header class="flex items-center mb-3 w-full py-4">    
    <p class="mr-auto">
        <a href="/projects"> My projects </a>/ {{$project->title}}
    </p>
    <a href="/projects/create" class="btn-blue">Add project</a>
</header>

<main class=" ">
    <div class="lg:flex">

        <div class="lg:w-3/4 px-3" >
            <div class="mb-6">

                <h2 class="text-gray-500 font-normal text-lg">Tasks</h2>
                @foreach ($project->tasks as $task)
                <div class="card mb-3" >
                    <form action="{{$task->path()}}" method="POST">
                        @method("PATCH")
                        @csrf
                        <div class="flex justify-end">

                            <input type="text" name="body" value="{{$task->body}}" class="w-full"/> 
                        <input type="checkbox" class="mr-2 " name="completed" id="completed" {{$task->completed ? 'checked' : ''}} onchange="this.form.submit()">
                        </div>
                    </form>
                </div> 
                                       
                @endforeach 
            <form action="{{$project->path(). "/tasks"}}" method="POST">
                @csrf
                <input type="text" class="w-full rounded p-3" name="body" id="body" placeholder="Add task">
            </form>
                
            </div>
            <div>
            <h2 class="text-gray-500 font-normal text-lg">General notes</h2>
            <form action="{{$project->path()}}" method="POST">
                @csrf
                @method("PATCH")
                
                <textarea class="card w-full" style="min-height:200px">{{$project->notes}}</textarea>
                <button type="submit" class="button">Enviar</button>
            </form>    
            </div>
        </div>
        <div class="px-3 lg:w-1/4">
            @include('projects.card')

        </div>
    </div>
</main>
@endsection

