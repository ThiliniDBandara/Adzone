<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AdZone') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="background: rgb(159,25, 50) !important;">
            <div class="container">
                <div class="col-lg-2">
                    <div class="row">
                        <a class="navbar-brand" href="{{ url('/') }}" style="color: #fff; font-size: 28px;">AdZone</a>
                        
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" style="color: #fff;">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" style="color: #fff;">{{ __('Register') }}</a>
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
                                </div>
                            </li>
                        @endguest
                        <li style="margin-top: 9px;"><a href="{{url('/addpost')}}" style="color: #fff; text-decoration: none;">Add Post</a></li>
                    </ul>
                </div>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-4">
                            <form action="" method="POST" class="form-horizontal">
                                <div class="form-group row">
                                    <div class="col-8">
                                        <input type="text" name="searachonproduct" id="searachonproduct" placeholder="Enter Product" class="form-control" style="margin-top: 5px;">
                                    </div>
                                    <div class="col-4">
                                        <input type="submit" class="btn btn-default" name="" value="Search" style="margin-top: 5px;">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-8">
                            <form action="" method="POST" class="form-horizontal">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <div class="col-6">
                                        <input type="text" name="states" id="states" class="form-control" placeholder="Enter State" style="margin-top: 5px;">
                                        <div id="stateList"></div>   
                                        <div id="cityList" 
                                        style="display: block; 
                                        position: absolute; 
                                        border-radius: 0px; 
                                        background: #fff;
                                        width: 88%; 
                                        padding: 0px 13px; 
                                        overflow-y: auto; 
                                        z-index: 1;">
                                        </div>  
                                         <input type="text" name="city" id="city" style="background: rgb(159,25,50); border: 1px solid rgb(159,25, 50); color: #fff;">                             </div>
                                    <div class="col-4">
                                        <select class="form-control dropdown" id="catogories" name="catogories" style="margin-top: 5px;">
                                            <option>Select</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="submit" name="searchads" value="Search" class="btn btn-default" style="margin-top: 5px;">
                                    </div>
                                </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
 $(document).ready(function(){
     $('#states').keyup(function(){
         var data;
         var srilankanstates = $(this).val();
         if(srilankanstates !=''){
             var _token = $('input[name="_token"]').val();
             $.ajax({
                 url: "{{ route('searchlocation.fetch') }}",
                 method: "POST",
                 data: {srilankanstates:srilankanstates, _token:_token},
                 success:function(data){
                     $('#sateList').fadeIn();
                     $('#stateList').html(data);
                 }
             });
         }
         else{
            $('#sateList').fadeOut();
            $('#stateList').html(data);
         }
         });
         $(document).on('click','#search',function(){
             $('#states').val($(this).text());
             $('#stateList').fadeOut(); 
         });

     });

     $(document).on('click','#stateList ul li',function(){
         var states = $('#states').val();
         var id = $(this).val();
         var _token = $('input[name="_token"]').val();
         $.ajax({
                 url: "{{ route('state.cities') }}",
                 method: "POST", 
                 data: {id:id, _token:_token},
                 success:function(data){
                    $('#cityList').fadeIn();
                    $('#cityList').html(data);  
                 }
             });

     });

     $(document).on('click','#cityList  ',function(e){
             var txt=$(e.target).text();
             $('#city').fadeIn();
             $('#city').val(txt);
             $('#cityList').fadeOut();
         });

    $(document).ready(function(){
        var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('catogories.retrieve') }}",
                 method: "POST",
                 data: {_token:_token},
                 success:function(data){
                    $('#catogories').fadeIn();
                     $('#catogories').html(data);
                     //alert(data);
                }
            });
        });

        $(document).ready(function(){
            if(window.location=="http://127.0.0.1:8000/"){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                url: "{{ route('catogories.ads') }}",
                 method: "GET",
                 data: {_token:_token},
                 success:function(data){
                   $('#Advertisments').html(data);
                     //$('#catogories').html(data);
                     //alert(data);
                }
            });
        }
    });
</script>
