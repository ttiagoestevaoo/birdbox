@extends('layouts.app')

@section('content')
<div class="w-full max-w-xs">


<form action="/projects" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 "  method="POST">
<h1 class="text-black font-bold text-lg mb-8">Create a project</h1>
    @csrf
    <div class="mb-4">
        <label for="title" class="block text-gray-700  font-bold mb-2 text-sm uppercase">Title</label>
    
        <div class="form-control">
            <input type="text" class="form-input" name='title' id='title'>
        </div>
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2 uppercase">Description</label>
    
        <div class="control">
            <textarea type="text" class=" form-textarea" name='description' id='description'> </textarea>
        </div>
    </div>

    
       

        <div class="control flex justify-between">
            <input type="submit"  id='submit' class='btn-blue is-link'>
            <a href="/projects">Cancelar</a>        
        </div>
    


</form>
</div>    
@endsection
