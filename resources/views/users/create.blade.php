@extends('layouts.app')

@section('body')
    <a href="./" class="btn btn-info">Naspat</a>
    <h1>Vytvaranie Noveho Zanestnanca</h1>

    {!! Form::open(['action'=> 'UserController@store', 'method' => 'POST'])!!}
        {{Form::label('name', 'name', ['class' =>'label label-default'])}}
        {{Form::text('name','',['class' => 'form-control'])}}
        <br>
        {{Form::label('email', 'email')}}
        {{Form::text('email','',['class' => 'form-control'])}}
        <br>
        {{Form::label('zameranie', 'zameranie')}}
        {{Form::text('zameranie','',['class' => 'form-control'])}}
        <br>
        {{Form::submit('Potvrdit', ['class' => 'btn btn-info'])}}
    {!!Form::close()!!}

@endsection