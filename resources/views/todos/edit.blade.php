@extends('layouts.app')

@section('body')
    <a href="./" class="btn btn-default">Naspat</a>
    <h1>Uprava todo</h1>

    {!! Form::open(['action'=> ['TodosController@update', $todo->id], 'method' => 'POST'])!!}
        {{Form::label('title', 'Title')}}
        {{Form::text('title',$todo->title,[])}}
        <br>
        {{Form::label('body', 'Text')}}
        {{Form::text('body',$todo->body,[])}}
        <br>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Potvrdit')}}
    {!!Form::close()!!}
{{-- 
    <form id='formular_nazov' >
        <input type="text" name="textarea" id="textarea" placeholder="sem napis nazov" class="textarea">

    </form>
    <br>
    <form id='formular_text' >
        <input type="text" name="textarea" id="textarea" placeholder="sem napis co chces robit" class="textarea">
    </form>
    <br>
    
    <input type="submit" value="submit" class="btn btn-submit"> --}}
@endsection