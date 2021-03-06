@extends('layouts.app')

@section('content')
    <header class="text-default flex items-center mb-3 w-full py-4">    
        <h1 class="mr-auto">My projects</h1>
        <a href="/projects/create" class="button" @click.prevent=$modal.show('new-project')>Add project</a>
    </header>

    <main class="flex flex-wrap justify-start sm:-mx-3 mx-3 ">
        @forelse($projects as $project)
            <div class="w-full sm:w-1/2  lg:w-1/3 xl:w-1/4 px-3 pb-6 " >

                @include('projects.card')
            </div>
        @empty
            <p class="text-default">No projects yet.</p>
        @endforelse
    </main>
            
   <new-project-modal> </new-project-modal>

@endsection