<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>lpdhu21001</title>
    <meta name="description" content="description"/>
    <meta name="author" content="author" />
    <meta name="keywords" content="keywords" />
    <link rel="stylesheet" href="<?php echo asset('css/landing.css')?>" type="text/css">
    <meta charset="UTF-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
  <body>
    <section id="first">
            <div class="login">
                <a id="home" class="login-text" href="{{url('/')}}">{{__('Home')}}</a>
                @if (Auth::check())
                <p class="login-text" id="log-user"><a href="{{url('/user/'.Auth::id())}}">{{__('User')}}</a>:&nbsp;&nbsp;<i>{{Auth::user()->name}}</i></p>
                @endif
                @php
                    $count = count(config('app.languages'));
                    $i = 1;
                @endphp
                @if(count(config('app.languages')) > 1)
                    <li class="language">
                        <div>
                            @foreach(config('app.languages') as $langLocale => $langName)
                                <a class="lang-text" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }}</a>
                                @if ($count > $i)
                                    <a class="lang-text">|</a>
                                @endif
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </div>
                    </li>
                @endif
                <div class="login2">
                    @auth
                        <a href="{{ url('/logout') }}" id="logout">{{__('Logout')}}</a>
                    @endauth
                </div>
            </div>
    </section>
    <section id="second">
        <div class="right">
            <p id="switch">{{__('Theme')}}: <button id="bswitch" class="switch" tabindex="0">{{__('Dark')}}</button></p>
            <button onclick="showCategory()" id="blogc">{{__('Blog Categories')}}</button>
            <script>
                function showCategory() {
                    window.location.href = "/category";
                }
            </script>
        </div>
    </section>
    <section id="third3">
        <div id="keyword-div">
            <form method="POST" action="{{action([App\Http\Controllers\KeywordController::class, 'store'])}}">
                @csrf
                <div id="cr-key">
                    <p id="cr-key-text"><b>{{__('Create Keyword')}}</b></p>
                    <input placeholder="{{__('Enter a Keyword')}}" type="text" name="id" id="keyword-id" class="cinp">
                    {{-- @if ($errors->any())
                        <div class="danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    @if($errors->has('id'))
                        <script>
                            $(document).ready(function(){
                                error = {!! str_replace("'", "\'", json_encode($errors->first('id'))) !!};
                                $('#keyword-id').attr("placeholder", error).val("").focus().blur();
                                $('#keyword-id').addClass('cinpp').removeClass('cinp');
                            });
                            $(document).on('click', '#keyword-id', function(){
                                var place = @json( __('Enter a Keyword'));
                                $('#keyword-id').attr("placeholder", place).val("").focus().blur();
                                $('#keyword-id').addClass('cinp').removeClass('cinpp');
                                $('#keyword-id').focus();
                            });
                        </script>
                    @endif
                    <input type="Submit" value="{{__('Create')}}">
                </div>
            </form>
            @php
                $i = -1;
            @endphp
            <form method="POST" action="{{action([App\Http\Controllers\KeywordController::class, 'update'], $i)}}">
                @csrf
                @method('PUT')
                <div id="ed-key" >
                    <p id="ed-key-text"><b>Edit Keyword</b></p>
                    <select id="id1" name="id1">
                            <option id="keyword-opt" class="cinp" value="" disabled selected>{{__('Select Keyword')}}</option>
                        @foreach ($keywords as $keyword)
                            <option value="{{$keyword->id}}">{{$keyword->id}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('id1'))
                        <script>
                            // alert("hello");
                            $(document).ready(function(){
                                error = {!! str_replace("'", "\'", json_encode($errors->first('id1'))) !!};
                                $("#keyword-opt").text(error);
                                $('#keyword-opt').addClass('cinpp').removeClass('cinp');
                            });
                            $(document).on('click', '#id1', function(){
                                var place = @json( __('Select Keyword'));
                                $("#keyword-opt").text(place);
                                $('#keyword-opt').addClass('cinp').removeClass('cinpp');
                            });
                        </script>
                    @endif
                    {{-- @if ($errors->any())
                        <div class="danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <br><br>
                    <input id="value" name="value" type="text" class="cinp" placeholder="{{__('Enter New Value')}}">
                    @if($errors->has('value'))
                        <script>
                            $(document).ready(function(){
                                error = {!! str_replace("'", "\'", json_encode($errors->first('value'))) !!};
                                $('#value').attr("placeholder", error).val("").focus().blur();
                                $('#value').addClass('cinpp').removeClass('cinp');
                            });
                            $(document).on('click', '#value', function(){
                                var place = @json( __('Enter New Value'));
                                $('#value').attr("placeholder", place).val("").focus();
                                $('#value').addClass('cinp').removeClass('cinpp');
                            });
                        </script>
                    @endif
                    <input type="Submit" value="{{__('Edit')}}">
                </div>
            </form>
            {{-- <form method="POST" action="{{action([App\Http\Controllers\KeywordController::class, 'destroy'], $i)}}">
                @csrf
                @method('DELETE')
                @php
                    $a = $blogs->diff($categories);
                @endphp
                <div id="del-key">
                    <p id="del-key-text"><b>Delete Keyword</b></p>
                    <select id="id2" name="id2">
                        <option id="keyword-opt1" class="cinp" value="" disabled selected>{{__('Select Keyword')}}</option>
                    @foreach ($keywords as $keyword)
                        @foreach ($a as $aa)
                            @if($keyword != $aa->keyword1 and $keyword != $aa->keyword2 and $keyword != $aa->keyword3 and $keyword != $aa->keyword4 and $keyword != $aa->keyword5)
                                <option value="{{$keyword->id}}">{{$keyword->id}}</option>
                            @else
                            @endif
                        @endforeach
                    @endforeach
                </select>
                <input type="Submit" value="{{__('Delete')}}">
                </div>
            </form> --}}
        </div>
        <script>
            if (getCookie('theme') == null){
                // alert("null");
                setCookie('theme', 'light');
           }
            if (getCookie('theme') == "dark"){;
                    var element = document.getElementById("bswitch");
                    var dark = @json( __('Dark'));
                    element.innerHTML = dark;
                    document.documentElement.classList.toggle('dark-mode');
                    document.querySelectorAll('.inverted').forEach(result => {
                        result.classList.toggle('invert');
                    });
                     // alert(getCookie('theme'));
            }
            if (getCookie('theme') == "light"){
                var element = document.getElementById("bswitch");
                var light = @json( __('Light'));
                element.innerHTML = light;
            }
            let button = document.querySelector('.switch');
            button.addEventListener('click', ()=>{
                // alert("hello");
                document.documentElement.classList.toggle('dark-mode');
                var element = document.getElementById("bswitch");
                if (getCookie('theme') == "light"){
                    var dark = @json( __('Dark'));
                    element.innerHTML = dark;
                    setCookie('theme', 'dark');
                    // alert(getCookie('theme'));
                }
                else if (getCookie('theme') == "dark"){
                    var light = @json( __('Light'));
                    element.innerHTML = light;
                    setCookie('theme', 'light');
                    // alert(getCookie('theme'));
                }
                document.querySelectorAll('.inverted').forEach(result => {
                        result.classList.toggle('invert');
                });
            })
            function setCookie(name, value) {
                var d = new Date();
                d.setTime(d.getTime() + (365*24*60*60*1000));
                var expires = "expires=" + d.toUTCString();
                document.cookie = name + "=" + value + ";" + expires + ";path=/";
            }
            function getCookie(name) {
                function escape(s) { return s.replace(/([.*+?\^$(){}|\[\]\/\\])/g, '\\$1'); }
                var match = document.cookie.match(RegExp('(?:^|;\\s*)' + escape(name) + '=([^;]*)'));
                return match ? match[1] : null;
            }
        </script>
    </section>
  </body>
</html>
