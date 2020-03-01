@extends('layouts.app')

@section('content')
<div class="rounded shadow-sm p-6 mx-auto w-1/2 bg-white">

    <h1 class="text-black font-bold text-lg mb-8">Edit a project</h1>
    <form action="{{$project->path()}}" class="px-8 pt-6 pb-8 mb-4 "  method="POST">
        @method("PATCH")
        @include('projects.form',['button'=> 'Update'])



    </form>
</div>    
@endsection
