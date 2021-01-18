@extends('layouts.app')

@section('body')
    <a href="./" class="btn">Naspat</a>
    <h1>CREATE TODO</h1>
    
    {!! Form::open(['action'=> 'TodosController@store', 'method' => 'POST', 'id' => 'todoForm'])!!}
        {{Form::label('title', 'Title', ['class' =>'label label-default'])}}
        {{Form::text('title','',['class' => 'form-control'])}}
        <p class="text-danger" id = 'titleError'></p>
        <br>
        {{Form::label('subject', 'Subject')}}
        {{Form::text('subject','',['class' => 'form-control'])}}
        <p class="text-danger" class="text-danger" id = 'subjectError'></p>

        <br>
        {{Form::label('body', 'Text')}}
        {{Form::textarea('body','',['class' => 'form-control'])}}     
        <p class="text-danger" id = 'bodyError'></p>

        <br>
        {{Form::submit('Potvrdit', ['class' => 'btn btn-info'])}}
    {!!Form::close()!!}

    {{-- <todos-form></todos-form>
    <example-component></example-component> --}}
{{--     
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Create TODO </div>

            <div class="card-body">
                <form action="TodosController@create" method="POST" >
                    <div class="form-group">
                        <input type="text" name="title" placeholder="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" placeholder="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="body" placeholder="body" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" value="Add todo" class="btn btn-info" id = "post_todo">
                    </div>
                </form>
            </div> --}}
            {{-- <example-component></example-component> --}}
            {{-- <todos-form></todos-form> --}}
            {{-- <script>
                // import axios from 'axios';
                function addTodo(){
                    console.log("funcia todo js ");
                    axios.post('http://localhost:8080/lar_skuska/public/todosCreate', data)
                    .then(function (response) {
                        // handle success
                        console.log(response);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
                }
                

                document.getElementById('post_todo').addEventListener('click', addTodo);
            </script> --}}
        {{-- </div>
    </div> --}}
@endsection