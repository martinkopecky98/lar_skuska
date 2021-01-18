@extends('layouts.app')
@section('body')
    <div class="card-header "><b>ZAMETESTNANCI</b> </div>

    {{-- <a class="btn btn-primary form-control" href="{{ url('/register')}}" tabindex="-1" aria-disabled="true">Vytvor</a> --}}
    <table id="DT_load" class="table table-bordered ">
        <thead>
            <tr>
                <th >ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Pozicia</th>
                <th>Nazov Projektu</th>
                <th>Veduci Projektu</th>
                <th>Moznosti</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @if ($user->pozicia != 'root')  
                    <tr>
                        <th>{{$user->id}}</th>
                        <th>{{$user->name}}</th>
                        <th><a href="users/{{$user->id}}/edit "> {{$user->email}} </a></th>
                        <th>{{$user->pozicia}}</th>
                        {{$x = false}}
                        @foreach ($projekty as $projekt)
                            @if ($projekt->oddelenie_id == $user->oddelenie_id AND $x == false)
                                <th> <a href="oddelenie/{{$projekt->oddelenie_id}}/edit"> {{$projekt->nazov}} </a> </th>
                                <th>{{$projekt->veduci}}</th>
                                {{$x = true}}
                            @endif
                        @endforeach
                        @if ($x == false)
                            <th>None</th>
                            <th>None</th>
                        @endif

                        {{-- @if($user->oddelenie_id == 0)
                            <th>None</th>
                            <th>None</th>
                        @else
                            <th> <a href="oddelenie/{{$user->oddelenie_id}}/edit"> {{$user->nazov}} </a> </th>
                            <th>{{$user->veduci}}</th>
                        @endif --}}

                        <th>                            
                            <br>
                            <button class="btn btn-info btn-mrg"><a  href="users/{{$user->id}}/edit">Upravit</a></button>
                           
                            <div>
                                {!!Form::open(['action'=> ['UserController@destroy', $user->id], 'method' => 'POST'])!!}
                                    {{-- {{Form::hiden('_method','DELETE')}} --}}
                                    @method('DELETE')
                                    {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}
                            </div> 
                        </th>

                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <script>
        // $(document).ready(function() {
        // $('#DT_load').DataTable();
        // });
        $(document).ready( function () {
    $('#DT_load').DataTable();
} );

    </script>

    {{-- <script src="../js/tabulka.js">
    </script> --}}
@endsection