<div class="card text-default flex flex-col" style="height: 250px;">
    <h3 class="text-xl mb-3 font-normal py-4 -ml-5 border-l-4 border-blue-300 pl-4"><a href="{{$project->path()}}">{{$project['title']}}</a></h3>
    <div class="text-gray-600">{{ \Illuminate\Support\Str::limit($project['description'],100) }}</div>

    @can('manage', $project)
        
    <footer class="mt-10 flex-1">
        <form action="{{$project->path()}}" class="text-right" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-sm">Delete</button>
        </form>
    </footer>
    @endcan
</div>
