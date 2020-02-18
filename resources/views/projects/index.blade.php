<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Title Page</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.0/css/bulma.css"/>
    </head>
    <body>
        <h1>Birdbox</h1>

        <ul>
            @foreach($projects as $project)
                <h1><a href="{{$project->path()}}">{{$project['title']}}</h1></a>
                <p>{{$project['description']}}</p>

            @endforeach
        </ul>
        
    </body>
</html>