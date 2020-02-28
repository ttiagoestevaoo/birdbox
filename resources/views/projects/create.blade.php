@extends('layouts.app')

@section('content')
<form action="/projects" class="" style="padding-top:40;" method="POST">
<h1>Create a project</h1>
    @csrf
    <div class="field">
        <label for="title" class="label">Title</label>
    
        <div class="control">
            <input type="text" name='title' id='title'>
        </div>
    </div>

    <div class="field">
        <label for="description" class="label">Description</label>
    
        <div class="control">
            <textarea type="text" name='description' id='description'> </textarea>
        </div>
    </div>

    <div class="field">
       

        <div class="control">
            <input type="submit"  id='submit' class='button is-link'>
            <a href="/projects">Cancelar</a>        
        </div>
    </div>


</form>
    
@endsection
