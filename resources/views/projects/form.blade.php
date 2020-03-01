@csrf
<div class="mb-4">
    <label for="title" class="block text-gray-700  font-bold mb-2 text-sm uppercase">Title</label>

    <div class="form-control">
        <input type="text" class="form-input" value="{{$project->title}}" name='title' id='title'>
    </div>
</div>

<div class="mb-4">
    <label for="description" class="block text-gray-700 text-sm font-bold mb-2 uppercase">Description</label>

    <div class="control">
        <textarea type="text" class=" form-textarea" name='description' id='description'>{{$project->description}} </textarea>
    </div>
</div>




<div class="control flex justify-between">
    <button class="btn-blue">{{$button}}</button>    
    <a href="/projects">Cancelar</a>        
</div> 

<div class="field mt-5">
    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>

        @endforeach
    @endif
</div>