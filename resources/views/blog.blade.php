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
  </head>
  <body>
    <section id="first">
            <div class="login">
                <a id="home" class="login-text" href="{{url('/')}}"> Home </a>
                {{-- <p id="lpd" class="login-text">©lpdhu21001</p> --}}
                @if (Route::has('login'))
                <div class="login2">
                    @auth
                        {{-- <a href="{{ url('/home') }}" class="login-text">Home</a> --}}
                        <a href="{{ url('/logout') }}" id="logout">Logout</a>
                    @else
                        <a href="{{ route('login') }}" class="login-text">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="login-text">Register</a>
                        @endif
                     @endauth
                </div>
                @endif
            </div>
    </section>
    <section id="second">
        <div class="right">
            <p id="switch">Theme: <button id="bswitch" class="switch" tabindex="0">Dark</button></p>
            <form type="POST" action="{{url('/search')}}">
                <input type="search" placeholder="Make a search" name="name">
                <button type="Submit">Search</button>
            </form>
            <button onclick="showCategory()" id="blogc">Blog Categories</button>
            {{-- @if (Auth::check()) --}}
            @foreach ($blog as $blog1)
                <button onclick="deleteBlog({{$blog1->id}})" id="blogdel">Delete</button>
            @endforeach
            {{-- @endif --}}
        </div>
    </section>
    <script>
        function showCategory() {
            window.location.href = "/category";
        }
        function deleteBlog(blogID) {
            window.location.href = "/blog/delete/" + blogID;
        }
    </script>
    <section id="third3">
        {{-- {{$blog}} --}}
        @foreach ($blog as $blog1)
        <div id="blogd">
            <h1 id="blogh">{{$blog1->name}}</h1>
            <img id="blogi" class="image inverted" src="{{$blog1->link}}">
            <p id="blogp">{{$blog1->content}}</p>
        </div>
        @endforeach
        <script>
            if (getCookie('theme') == null){
                // alert("null");
                setCookie('theme', 'light');
           }
            if (getCookie('theme') == "dark"){
                    document.documentElement.classList.toggle('dark-mode');
                    document.querySelectorAll('.inverted').forEach(result => {
                        result.classList.toggle('invert');
                    });
                     // alert(getCookie('theme'));
            }
            if (getCookie('theme') == "light"){
                var element = document.getElementById("bswitch");
                element.innerHTML = "Light";
            }
            let button = document.querySelector('.switch');
            button.addEventListener('click', ()=>{
                // alert("hello");
                document.documentElement.classList.toggle('dark-mode');
                var element = document.getElementById("bswitch");
                if (getCookie('theme') == "light"){
                    element.innerHTML = "Dark";
                    setCookie('theme', 'dark');
                    // alert(getCookie('theme'));
                }
                else if (getCookie('theme') == "dark"){
                    element.innerHTML = "Light";
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
        {{-- {{$blog->id}} --}}
        {{-- <h1 class="imgt">{{$blog->name}}</h1> --}}
    </section>
    {{-- <section id="fourth">
        <div>

        </div>
    </section> --}}
  </body>
</html>
