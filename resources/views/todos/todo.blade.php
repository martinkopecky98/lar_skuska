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
{{-- <h1>TODO APLIKACIA</h1> --}}
<div class="card-header">TODO APLIKACIA</div>

    <a class="btn btn-primary  " href="{{ url('/todos/create')}}" tabindex="-1" aria-disabled="true">Vytvor</a>
  
    @if(count($todos) > 0)
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
                                <p><b> Stav: </b>{{$todo->progres}}</p>
                                <small><b> Zacal pracovat : </b>{{$todo->created_at}}</small>
                                <small><b>Naposledy spravil update:</b> {{$todo->updated_at}}</small>
                                <br>
                                <button class="btn btn-info"><a  href="todos/{{$todo->todo_id}}/edit">Upravit</a></button>
                                
                                {{-- {!!Form::open(['action'=> ['TodosController@destroy', $todo->todo_id], 'method' => 'POST'])!!}
                                    @method('DELETE')
                                    {{Form::submit('Delete',['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!} --}}
                                <button class="btn btn-danger" id="delete_todo" onclick="delete_todo({{$todo->todo_id}})">Vymazat Todo</button>

                                <br>
                                
                                <script>
                                    function delete_todo(index)
                                    {
                                        console.log("delete todo funcia");
                                        console.log(index);
                                        axios
                                        // .post('http://localhost:8080/lar_skuska/public/todos/DeleteJS',{params: index})
                                        .delete('http://localhost:8080/lar_skuska/public/todos/'+index+'/DeleteJS')
                                        // .delete('http://localhost:8080/lar_skuska/public/todos/DeleteJS', {params: index})
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
                                
                        </div>
                    </div>
               </li>
            @endforeach
        </ul>
    </div>
    @else
        <p>Ziadne veci na pracu</p>
    @endif
@endsection