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
                <a id="home" class="login-text" href="{{url('/')}}">{{__('Home')}} </a>
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
                        <a class="login-text" href="{{ url('/logout') }}" id="logout">{{__('Logout')}}</a>
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
        {{-- @foreach ($blog as $blog1)
            {{$blog1}}
        @endforeach --}}
        @foreach ($blog as $blog1)
        <form method="POST" action="{{action([App\Http\Controllers\BlogController::class, 'update'], $blog1->id)}}" id="blogform">
            @csrf
            @method('PUT')
            {{-- @if ($errors->any())
                <div class="danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            <input type="text" name="name" placeholder="{{$blog1->name}}" class="cinp" id="name">
            @if($errors->has('name'))
                <script>
                    $(document).ready(function(){
                        error = {!! str_replace("'", "\'", json_encode($errors->first('name'))) !!};
                        $('#name').attr("placeholder", error).val("").focus().blur();
                        $('#name').addClass('cinpp').removeClass('cinp');
                    });
                    $(document).on('click', '#name', function(){
                        name = {!! str_replace("'", "\'", json_encode($blog1->name)) !!}
                        $('#name').attr("placeholder", name).val("").focus().blur();
                        $('#name').addClass('cinp').removeClass('cinpp');
                        $('#name').focus();
                    });
                </script>
            @endif
            <br>
            <br>
            <textarea type="text" name="content" placeholder="{{$blog1->content}}" id="content" class="cinp"></textarea>
            <br>
            @if($errors->has('content'))
                <script>
                    $(document).ready(function(){
                        error = {!! str_replace("'", "\'", json_encode($errors->first('content'))) !!};
                        $('#content').attr("placeholder", error).val("").focus().blur();
                        $('#content').addClass('cinpp').removeClass('cinp');
                    });
                    $(document).on('click', '#content', function(){
                        content = {!! str_replace("'", "\'", json_encode($blog1->content)) !!}
                        $('#content').attr("placeholder", content).val("").focus().blur();
                        $('#content').addClass('cinp').removeClass('cinpp');
                        $('#content').focus();
                    });
                </script>
            @endif
            <br>
            <input type="text" name="link" placeholder="{{$blog1->link}}" id="link" class="cinp">
            @if($errors->has('link'))
                <script>
                    $(document).ready(function(){
                        error = {!! str_replace("'", "\'", json_encode($errors->first('link'))) !!};
                        $('#link').attr("placeholder", error).val("").focus().blur();
                        $('#link').addClass('cinpp').removeClass('cinp');
                    });
                    $(document).on('click', '#link', function(){
                        content = {!! str_replace("'", "\'", json_encode($blog1->link)) !!}
                        $('#link').attr("placeholder", content).val("").focus().blur();
                        $('#link').addClass('cinp').removeClass('cinpp');
                        $('#link').focus();
                    });
                </script>
            @endif
            <br>
            <br>
            {{-- <input type="text" name="keyword1" placeholder="Keyword1 (can be empty)"> --}}
            {{-- @foreach ($keywords as $keyword)
            {{$keyword->id}}
            {{$keyword}}
            @endforeach --}}
            <select name="keyword1">
                {{-- @foreach ($blog as $blog1) --}}
                    @if ($blog1->keyword1 != 0)
                    <option value="" disabled selected>{{$blog1->keyword1}}</option>
                    @else
                    <option value="" disabled selected>{{__('Keyword 1 (can be empty)')}}</option>
                    @endif
                {{-- @endforeach --}}
                @foreach ($keywords as $keyword)
                    <option value="{{$keyword->id}}">{{$keyword->id}}</option>
                @endforeach
            </select>
            <br>
            <br>
            <select name="keyword2">
                {{-- @foreach ($blog as $blog1) --}}
                    @if ($blog1->keyword2 != 0)
                    <option value="" disabled selected>{{$blog1->keyword2}}</option>
                    @else
                    <option value="" disabled selected>{{__('Keyword 2 (can be empty)')}}</option>
                    @endif
                {{-- @endforeach --}}
                @foreach ($keywords as $keyword)
                    <option value="{{$keyword->id}}">{{$keyword->id}}</option>
                @endforeach
            </select>
            <br>
            <br>
            <select name="keyword3">
                {{-- @foreach ($blog as $blog1) --}}
                    @if ($blog1->keyword3 != 0)
                    <option value="" disabled selected>{{$blog1->keyword3}}</option>
                    @else
                    <option value="" disabled selected>{{__('Keyword 3 (can be empty)')}}</option>
                    @endif
                {{-- @endforeach --}}
                @foreach ($keywords as $keyword)
                    <option value="{{$keyword->id}}">{{$keyword->id}}</option>
                @endforeach
            </select>
            <br>
            <br>
            <select name="keyword4">
                {{-- @foreach ($blog as $blog1) --}}
                    @if ($blog1->keyword4 != 0)
                    <option value="" disabled selected>{{$blog1->keyword4}}</option>
                    @else
                    <option value="" disabled selected>{{__('Keyword 4 (can be empty)')}}</option>
                    @endif
                {{-- @endforeach --}}
                @foreach ($keywords as $keyword)
                    <option value="{{$keyword->id}}">{{$keyword->id}}</option>
                @endforeach
            </select>
            <br>
            <br>
            <select name="keyword5">
                {{-- @foreach ($blog as $blog1) --}}
                    @if ($blog1->keyword5 != 0)
                    <option value="" disabled selected>{{$blog1->keyword5}}</option>
                    @else
                    <option value="" disabled selected>{{__('Keyword 5 (can be empty)')}}</option>
                    @endif
                {{-- @endforeach --}}
                @foreach ($keywords as $keyword)
                    <option value="{{$keyword->id}}">{{$keyword->id}}</option>
                @endforeach
            </select>
            <br>
            <br>
            {{-- <input type="text" name="category_id" placeholder="Blog Category (can be empty)"> --}}
            <select name="category_id">
                {{-- @foreach ($blog as $blog1) --}}
                    @if ($blog1->category_id != 0)
                    <option value="" disabled selected>{{$blog1->category_id}}</option>
                    @else
                    <option value="" disabled selected>{{__('Blog Category (can be empty)')}}</option>
                    @endif
                {{-- @endforeach --}}
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->id}}</option>
                @endforeach
            </select>
            <br>
            <br>
            <input type="submit" value="{{__('Edit Blog')}}" id="blogadd">
        </form>
        @endforeach
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
