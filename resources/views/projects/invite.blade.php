<div class="card flex flex-col mt-3" style="">
    <h3 class="font-normal text-sm mb-3 border-l-4 -ml-5 py-4 pl-4 border-blue-200">
        Invite a user
    </h3>

<form action="{{$project->path().'/invitations'}}" method="POST">
    @csrf

    <input type="email" name="email" id="email" class="border bg-card border-gray rounded mb-4" placeholder="Email address">

    <button type="submit" class="text-xs button">Convidar</button>
</form>
@include('projects.errors', ['bag' => 'invitations'])
</div>