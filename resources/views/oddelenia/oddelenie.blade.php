@extends('layouts.app')

@section('body')
    <a href="./" class="btn btn-default">Naspat</a>
    <h1>Uprava todo</h1>
    
{{-- 
    {!! Form::open(['action'=> ['TodosController@update', $todo->id], 'method' => 'POST'])!!}
        {{Form::label('title', 'Title', ['class' =>'label label-default'])}}
        {{Form::text('title',$todo->title,['class' => 'form-control'])}}
        <br>
        {{Form::label('subject', 'Subject')}}
        {{Form::text('subject',$todo->subject,['class' => 'form-control'])}}        
        <br>
        {{Form::label('body', 'Text')}}
        {{Form::textarea('body',$todo->body,['class' => 'form-control'])}}
        <br>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Potvrdit',  ['class' => 'btn btn-info'])}}
    {!!Form::close()!!} --}}
@endsection