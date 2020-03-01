@extends('layouts.app')

@section('content')
<div class="rounded shadow-sm p-6 mx-auto w-1/2 bg-white">

    <form action="/projects" class="px-8 pt-6 pb-8 mb-4 "  method="POST">
        <h1 class="text-black font-bold text-lg mb-8">Create a project</h1>
        @include('projects.form',['project' => new App\Project,'button'=> 'Create'])



    </form>
</div>    
@endsection
