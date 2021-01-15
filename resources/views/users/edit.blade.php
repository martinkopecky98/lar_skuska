@extends('layouts.app')

@section('body')
    <a href="../" class="btn btn-info">Naspat</a>
    <h1>Uprava Zanestnanca</h1>

    {!! Form::open(['action'=> ['UserController@update', $user->id], 'method' => 'POST'])!!}
        {{Form::label('name', 'name', ['class' =>'label label-default'])}}
        {{Form::text('name',$user->name,['class' => 'form-control'])}}
        <br>
        {{Form::label('email', 'email')}}
        {{Form::text('email',$user->email,['class' => 'form-control'])}}
        <br>
        {{Form::label('zameranie', 'zameranie')}}
        {{Form::text('zameranie',$user->user_zameranie,['class' => 'form-control'])}}
        <br>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Potvrdit', ['class' => 'btn btn-info'])}}
    {!!Form::close()!!}

@endsection