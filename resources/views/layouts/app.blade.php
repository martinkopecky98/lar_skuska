<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    {{-- <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"> --}}




    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css" /> 
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script> --}}

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}
    {{-- <script scr="{{ asset('js/validacia.js') }}" type= "text/javascript"></script> --}}
    
    {{-- <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> --}}

    {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.23/datatables.min.js"></script> --}}

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.23/datatables.min.css"/>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> --}}

    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> --}}

</head>
<body>
    <div id="app">
       @include('shered.navbar')
        <div class="container">
            @include('shered.messages')
            @yield('content')
            @yield('body')
            
        </div>
        @include('shered.footer')
    </div>
    
</body>
{{-- <script src="./js/app.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        console.log("tabulka je v p ");
        $('#DT_load').DataTable();
    } );
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
    $(document).ready( function () {
    $('#todoForm').submit(function(event)
        {
            event.preventDefault();
            var title = $('#todoForm').find('input[name="title"]').val();
            var subject = $('#todoForm').find('input[name="subject"]').val();
            var body = $('#todoForm').find('textarea[name="body"]').val();
            var podm = true;
            // console.log(title, subject, body);
            // console.log('prevent default');
            if(!kontrola(title) && !kontrola(subject) && !kontrola(body) && podm )
            {
                console.log('presslo kontrolou jeje');   
                $('#todoForm').get(0).submit();
                // $('#todoForm').submit();
                // podm = false;
            } else 
            {
                console.log("nepreslo kontrolou :(");
                var titleError = kontrola(title) ? "chyba ti title" : " ";
                var subjectError = kontrola(subject) ? "chyba ti subject" : " ";
                var bodyError = kontrola(body) ? "chyba ti body" : " ";
                $('#titleError').html(titleError);
                $('#subjectError').html(subjectError);
                $('#bodyError').html(bodyError);
            }
        })
    });
    function kontrola(data)
    {
        return data == undefined || data.length == 0;
    }
</script>



{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
        <script type="module">
        $(document).ready(function(){
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
            axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
            $('#formular').submit(function(e){
                e.preventDefault();
                var data = new FormData()
                data.set("text", e.target.childNodes[1].value)
                data.set("_token", "{{ csrf_token() }}")
                
               axios.get("http://localhost:8080/lar_skuska/public/todos/storeJS")
               .then(function (response) {
                        console.log(response.data);
                        vypis(response.data)
                    })
                    .catch(function (error) {
                        console.log(error);
                })
            //    axios.post("http://localhost:8080/lar_skuska/public/todos/storeJS", data)
            //    .then(function (response) {
            //             console.log(response.data);
            //             vypis(response.data)
            //         })
            //         .catch(function (error) {
            //             console.log(error);
            //     })
            });

            function vypis(pole){
                var polee = '';
                for (let index = 0; index < pole.length; index++) {
                    //console.log(som tu);
                    polee += /*"<li> <a class="btn" href="./contact">Vymazat</a>*/ "<li>" + pole[index].text +"</li>"+
                    "<a class='btn' href='{{ url('todos/')}}/"+pole[index].id+"/delete'>Vymazat</a>";
                    "<a class='btn' href='{{ url('todos/') }}/"+pole[index].id+"/edit'>Upravit</a>";
                    // "<a class='btn' href='{{ url('todo/delete/') }}/"+pole[index].id+"'>Vymazat</a>";
                    // "<a class='btn' href='{{ url('todo/edit/') }}/"+pole[index].id+"'>Upravit</a>";
                    //console.log(uz tu niesom);
                }
                $('#vypis').html(polee);
            }
            
        });
    </script>  --}}
</html>
