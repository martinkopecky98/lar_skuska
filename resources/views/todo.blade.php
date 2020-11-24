@extends('layouts.app')

@section('body')
{{-- <h1>{{$title}}</h1>

<form id='formular' >
    <input type="text" name="textarea" id="textarea" placeholder="sem napis co chces robit" class="textarea">
    @csrf
    <input type="submit" value="submit" class="btn btn-submit">
</form>

<ul id='vypis'>
    <p>vypisovanie tvojich todo veci</p>
    @foreach ($data as $todo)
        <li> 
            <p> {{$todo->text}} </p>
            <a class='btn' href='{{ url('todo/delete/'.$todo->id) }}'>Vymazat</a>
        </li>
    @endforeach
</ul> --}}
TODOOOS
    @if(count($todos) > 1)
        @foreach ($todos as $todo)
            <div class="panel panel-default">
                    <div class="panel-heading">
                        <br>
                        <h3>{{$todo->title}}</h3>
                    </div>

                    <div class="panel-body">
                         <p>{{$todo->body}}</p>
                        <small>{{$todo->created_at}}</small>
                        @foreach ($users as $user)
                        @if ($user->id == $todo->user_id)
                            <br>
                            <small>{{$user->email}}</small>
                        @endif

                        {{-- @php
                            if( $user->id == $todo->user_id)
                            {
                              <small>$user->email</small>
                            }
                            
                        @endphp --}}
                            
                        @endforeach

                        <br>
                        <button><a  href="todos/{{$todo->id}}/edit">Upravit</a></button>
                        
                        <br>
                        {!!Form::open(['action'=> ['TodosController@destroy', $todo->id], 'method' => 'POST'])!!}
                            {{-- {{Form::hiden('_method','DELETE')}} --}}
                            @method('DELETE')
                            {{Form::submit('Delete',[])}}
                        {!!Form::close()!!}
                        <br>
                </div>
            </div>
            
        @endforeach
    @else
        <p>Ziadne veci na pracu</p>
    @endif
@endsection