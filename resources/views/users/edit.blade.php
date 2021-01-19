@extends('layouts.app')

@section('body')
    <a href="../" class="btn btn-info">Naspat</a>
    <h1>Uprava Zanestnanca</h1>
    {{-- {{dd($user)}} --}}
    {!! Form::open(['action'=> ['UserController@update', $user->id], 'method' => 'POST','id' => 'usersForm'])!!}

        {{Form::label('name', 'name', ['class' =>'label label-default'])}}
        {{Form::text('name', $user->name,['class' => 'form-control'])}}
        <p class="text-danger" id='titleError'></p>

        <br>
        {{Form::label('email', 'email')}}
        {{Form::text('email', $user->email,['class' => 'form-control'])}}
        <p class="text-danger" id='subjectError'></p>

        <br>

        @if ($user->oddelenie_id == 0) 
        
            {{Form::label('oddelenie', 'oddelenie')}} 
            {{Form::label('oddelenie', 'None')}} 
        {{-- <p class="text-danger" id='titleError'></p> --}}

            <br>
            {{Form::label('veduci', 'veduci')}}
            {{Form::text('veduci', 'none',['class' => 'form-control'])}}
        <p class="text-danger" id='veduciError'></p>

        
        @else   
             {{-- {{dd($user)}} --}}
        
            {{Form::label('oddelenie', 'oddelenie')}} 
            {{Form::label('oddelenie', $user->nazov)}} 
        {{-- <p class="text-danger" id='titleError'></p> --}}

            <br>
            {{Form::label('veduci', 'veduci')}}
            {{Form::text('veduci', $user->veduci,['class' => 'form-control'])}}
        <p class="text-danger" id='veduciError'></p>

        
        @endif
        
        <br>
        {{Form::label('pozicia', 'pozicia')}}
        {{Form::text('pozicia', $user->pozicia,['class' => 'form-control'])}}
        <p class="text-danger" id='poziciaError'></p>

        <br>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Zmenit', ['class' => 'btn btn-info'])}}
    {!!Form::close()!!}

    <button class="btn btn-primary" id="zmena_pozicie" onclick="zmena_pozicie({{$user->id}})" method = 'GET'>Zmenit Poziciu</button>

    <div class="list-group">
        <ul class="list-group">
            @foreach ($todos as $todo)
                <li class="list-group-item">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <br>
                                {{-- <h3>{{$todo->title}}</h3> --}}
                                <h4> <b> Projekt na ktorom pracuje :</b>   {{$todo->subject}}</h4>
                            </div>
    
                            <div class="panel-body">
                                <p><b> Uloha na ktorej pracuje : </b>{{$todo->body}}</p>
                                <small><b> Zacal pracovat : </b>{{$todo->created_at}}</small>
                                <small><b>Naposledy spravil update:</b> {{$todo->updated_at}}</small>
                                <br>
                                <small><b>Progres:</b> {{$todo->progres}}</small>
                                <br>
                                {{-- <button class="btn btn-info"><a  href="todos/{{$todo->id}}/edit">Upravit</a></button>
                                
                                <br>
                                {!!Form::open(['action'=> ['TodosController@destroy', $todo->id], 'method' => 'POST'])!!}
                                    @method('DELETE')
                                    {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}
                                <br> --}}
                        </div>
                    </div>
               </li>
            @endforeach
        </ul>
    </div>
    {{-- <FORM>
        <INPUT Type="button" VALUE="Reload Page" onClick="history.go(0)">
    </FORM>
             --}}
    {{-- <script>console.log("zmenaaa pozicieee pozadie");</script> --}}
    {{-- <script src=".../js/zmenaPozicie.js"></script> --}}
    
    <script>
        function zmena_pozicie(index)
        {
            console.log("zmenaaa pozicieee funcia");
            console.log(index);
            axios
            .post('http://localhost:8080/lar_skuska/public/users/ZmenaPozicie',{params: index})
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
@endsection