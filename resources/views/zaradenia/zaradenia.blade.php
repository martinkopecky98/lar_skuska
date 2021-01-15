@extends('layouts.app')
@section('body')
    <div class="card-header ">ZAMETESTNANCI</div>

    <a class="btn btn-primary form-control" href="{{ url('/register')}}" tabindex="-1" aria-disabled="true">Vytvor</a>
    <table id="DT_load" class="table table-bordered ">
        <thead>
            <tr>
                <th >Zamestnanec</th>
                <th>Oddelenie</th>
                <th>Bol priradeny</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $elem)
                <tr>
                    <th>{{$elem->id}}</th>
                    <th>{{$user->name}}</th>
                    <th>{{$user->email}}</th>
                    <th>{{$user->user_zameranie}}</th>
                    <th>                            <br>
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
            @endforeach
        </tbody>
    </table>
    <script src="js/tabulka.js">
    </script>
@endsection