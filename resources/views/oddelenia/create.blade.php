@extends('layouts.app')

@section('body')
    <a href="./" class="btn btn-default">Naspat</a>
    <h1>Vytvaranie Oddelenia</h1>

    {!! Form::open(['action'=> 'OddelenieController@store', 'method' => 'POST'])!!}
        {{Form::label('nazov', 'nazov oddelenia', ['class' =>'label label-default'])}}
        {{Form::text('nazov','',['class' => 'form-control'])}}
        <br>
        {{Form::label('veduci', 'veduci oddelenia')}}
        {{Form::text('veduci','',['class' => 'form-control'])}}        
        <br>
        {{Form::submit('Potvrdit', ['class' => 'btn btn-info'])}}
    {!!Form::close()!!}

    {{-- {!! Form::open(['action'=> 'TodosController@store', 'method' => 'POST'])!!}
        {{Form::label('title', 'Title', ['class' =>'label label-default'])}}
        {{Form::text('title','',['class' => 'form-control'])}}
        <br>
        {{Form::label('subject', 'Subject')}}
        {{Form::text('subject','',['class' => 'form-control'])}}
        <br>
        {{Form::label('body', 'Text')}}
        {{Form::textarea('body','',['class' => 'form-control'])}}        
        <br>
        {{Form::submit('Potvrdit', ['class' => 'btn btn-info'])}}
    {!!Form::close()!!} --}}
@endsection