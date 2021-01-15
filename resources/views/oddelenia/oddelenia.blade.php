@extends('layouts.app')
@section('body')
    <div class="card-header ">Oddelenia</div>

    <a class="btn btn-primary form-control" href="{{ url('/register')}}" tabindex="-1" aria-disabled="true">Vytvor</a>
    <table id="DT_load" class="table table-bordered ">
        <thead>
            <tr>
                <th >ID</th>
                <th>Name</th>
                <th>Veduci</th>
                <th>Vyrobene</th>
            </tr>
        </thead>
        <tbody>
            {{dd($oddelenia)}}
            @foreach ($oddelenia as $elem)
                <tr>
                    <th>{{$elem->id}}</th>
                    <th>{{$elem->nazov}}</th>
                    <th>{{$elem->veduci}}</th>
                    <th>{{$elem->created_at}}</th>
                    <th>                            <br>
                        <button class="btn btn-info btn-mrg"><a  href="users/{{$elem->id}}/edit">Upravit</a></button>
                        
                        <div>
                            {!!Form::open(['action'=> ['OddelenieController@destroy', $elem->id], 'method' => 'POST'])!!}
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