<div class="card" style="height: 300px;">
    <h3 class="text-xl mb-3 font-normal py-4 -ml-5 border-l-4 border-blue-300 pl-4"><a href="{{$project->path()}}">{{$project['title']}}</a></h3>
    <div class="text-gray-600">{{ \Illuminate\Support\Str::limit($project['description'],100) }}</div>
</div>
