<div> 
    <img style="w-100" src="http://localhost:8080/lar_skuska/public/storage/images/Capture.JPG">
  </div>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{-- {{ config('app.name', 'Laravel') }} --}}
            <b>Firma</b>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                {{-- <li class="nav-item active">
                   <a class="nav-link" href="{{url('/')}}">HomePAGE</a> <span class="sr-only">(current)</span> </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/oddelenie')}}">Oddelenia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/users')}}">Zamestnanci</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/todos')}}">TO_DO</a>
                  </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('/zaradenie')}}">Zaradenia</a>
                </li> --}}
                {{-- <li class="nav-item">
                  <a class="nav-link disabled" href="{{ url('/create')}}" tabindex="-1" aria-disabled="true">Vytvor</a>
                </li> --}}

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                    </a>                            


                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    
                    <a class="dropdown-item" href="users/{{auth()->user()->id}}/edit"
                    {{-- onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"> --}}
                    >Profil
                    </a>  
                    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form> --}}
                </div>
              </li>
              {{-- <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('profil') }}"
                  onclick="event.preventDefault();
                                document.getElementById('profil-form').submit();">
                   {{ __('profil') }}
                  </a>                            


                    <form id="profil-form" action="{{ route('profil') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li> --}}
                @endguest
            </ul>
        </div>
    </div>
</nav>