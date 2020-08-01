@extends('layouts.app')

@section('content')

<form action="" method="GET">

    <date-picker-input msg="startDate" > </date-picker-input>
    <date-picker-input  msg="endDate"> </date-picker-input>
    <button type="submit">Enviar</button>
</form>
@endsection