@extends('layouts.app')

@section('body')
    <button class="btn btn-info"><a href="{{ url('/oddelenie')}}" class="btn btn-default">Naspat</a></button>
    {{-- {{dd($oddelenie)}} --}}
    <h1>{{$oddelenie[0]->nazov}}</h1>
    
    {!! Form::open(['action'=> ['OddelenieController@update', $oddelenie[0]->oddelenie_id], 'method' => 'POST'])!!}

        <br>
        {{Form::label('nazov', 'nazov')}} 
        {{Form::text('nazov',$oddelenie[0]->nazov,['class' => 'form-control'])}}        
        <br>
        {{Form::label('veduci', 'veduci')}} 
        {{Form::text('veduci',$oddelenie[0]->veduci,['class' => 'form-control'])}}
        <br>
        {{-- <li class="list-group">
            @foreach ($oddelenie as user)
                <a href="users/{{$user->id}}" class="list-group-item">First item</a>
            @endforeach
        </li> --}}
        <table id="DT_load" class="table table-bordered ">
            <thead>
                <tr>
                    <th >ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Pozicia</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($oddelenie as $elem)
                    {{-- {{dd($elem)}} --}}
                    <tr>
                        <th>{{$elem->id}}</th>
                        <th>{{$elem->name}}</th>
                        <th> <a href="users/{{$elem->id}}"> {{$elem->email}} </a> </th>
                        <th>{{$elem->pozicia}}</th>
                        <th>                            
                            <button class="btn btn-danger">
                                <a href='../../oddelenie/{{$elem->id}}/removeUser' class="btn btn-default">vyhodit z projektu</a>
                            </button>
                            {{-- <button class="btn btn-danger text-dark"> 
                                <a href="oddelenie/{{$elem->id}}/removeUser" class="btn btn-danger"> vyhodit z projektu</a> 
                            </button>  --}}
                                {{-- {!!Form::open(['action'=> ['OddelenieController@removeUser', $elem->id], 'method' => 'POST'])!!}
                                    @method('DELETE')
                                {{Form::submit('Delete',['class' => 'btn btn-danger'])}} 
                                {!!Form::close()!!} --}}
                        </th>

                    </tr>
                @endforeach
            </tbody>

        </table>
        
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Potvrdit',  ['class' => 'btn btn-info'])}}
    {!!Form::close()!!}
@endsection