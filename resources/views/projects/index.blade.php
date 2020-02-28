@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 w-full py-4">    
        <h1 class="mr-auto">My projects</h1>
        <a href="/projects/create" class="btn-blue">Add project</a>
    </header>

    <main class="flex flex-wrap justify-start sm:-mx-3 mx-3 ">
        @forelse($projects as $project)
            <div class="w-full sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6 px-3 pb-6 " >

                @include('projects.card')
            </div>
        @empty
            <p>No projects yet.</p>
        @endforelse
    </main>
            

    
   
@endsection