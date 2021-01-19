@extends('layouts.app')

@section('body')
    <a href="{{url('/todos')}}" class="btn btn-default">Naspat</a>
    <h1>Uprava todo</h1>

    {!! Form::open(['action'=> ['TodosController@update', $todo->todo_id], 'method' => 'POST', 'id' => 'todoForm' ])!!}
        {{Form::label('title', 'Title', ['class' =>'label label-default'])}}
        {{Form::text('title',$todo->title,['class' => 'form-control'])}}
        <p class="text-danger" id='titleError'></p>
        <br>
        {{Form::label('subject', 'Subject')}}
        {{Form::text('subject',$todo->subject,['class' => 'form-control'])}}       
        <p class="text-danger" id='subjectError'></p>

        <br>
        {{Form::label('body', 'Text')}}
        {{Form::textarea('body',$todo->body,['class' => 'form-control'])}}
        <p class="text-danger" id='bodyError'></p>

        <br>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Potvrdit',  ['class' => 'btn btn-info'])}}
    {!!Form::close()!!}
    {{-- <label class="label label-default">{{$todo->progres}}</label> --}}
    {{Form::label('progres', $todo->progres, ['class' =>'label label-default'])}}

    <button class="btn btn-primary" id="zmena_progresu" onclick="zmena_progresu({{$todo->todo_id}})" method = 'GET'>Zmenit Progres</button>
    <script>
        function zmena_progresu(index)
        {
            console.log("zmenaaa progresu funcia");
            console.log(index);
            axios
            .post('http://localhost:8080/lar_skuska/public/todos/ZmenaProgresu',{params: index})
            // .get('http://localhost:8080/lar_skuska/public/users/ZmenaPozicie')
            // .post('../ZmenaPozicie')
            .then(function (response) {
                    console.log(response.data);
                    history.go(0);
                })
            .catch(function (error) {
                console.log(error);
            })
        }

        // document.getElementById('zmena_pozicie').addEventListener('click', zmena_pozicie);
    </script>

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