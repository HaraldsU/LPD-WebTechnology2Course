<script>
    var perfEntries = performance.getEntriesByType("navigation");

    if (perfEntries[0].type === "back_forward") {
        location.reload(true);
    }
</script>
{{-- blogsearch file --}}
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
                <a id="home" class="login-text" href="{{url('/')}}"> Home </a>
                @if (Auth::check())
                    <p class="login-text" id="log-user">User:&nbsp;&nbsp;<i>{{Auth::user()->name}}</i></p>
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
                {{-- <p id="lpd" class="login-text">©lpdhu21001</p> --}}
                @if (Route::has('login'))
                <div class="login2">
                    @auth
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
        {{-- {{$category}} --}}
        <div class="right">
            <p id="switch">Theme: <button id="bswitch" class="switch" tabindex="0">Dark</button></p>
            <form method="POST" action="{{route('bsearch1')}}" class="sform">
                @csrf
                <input type="text" placeholder="Search Blog by Category" name="search">
                <button type="submit">Search</button>
                <input type="checkbox" name="keyword" id="keyword" required>
                <label for="keyword">By Keyword</label>
                <input type="checkbox" name="name" id="name" required>
                <label for="name">By Name</label>
                <input type="hidden" name="category" value="{{$category}}">
            </form>
            <script>
                $(function(){
                    var requiredCheckboxes = $('.sform :checkbox[required]');
                    requiredCheckboxes.change(function(){
                        if(requiredCheckboxes.is(':checked')) {
                            requiredCheckboxes.removeAttr('required');
                        } else {
                            requiredCheckboxes.attr('required', 'required');
                        }
                    });
                });
            </script>
            <button onclick="showCategory()" id="blogc">Blog Categories</button>
            {{-- @if (Auth::check()) --}}
            <button onclick="createBlog()" id="createb">Create New Blog</button>
            {{-- @endif --}}
        </div>
    </section>
    <section id="third3">
        {{-- @php ($i = 1) --}}
        @if (count($blogs) > 0)
        @foreach ($blogs->reverse() as $blog)
         {{-- @if ($i != 5) --}}
            <div class="img1">
                <h1 class="imgt">{{$blog->name}}</h1>
                <a onclick="showBlog({{$blog->id}})"><img id="imgc" class="image inverted" src="{{$blog->link}}"></a>
            </div>
        @endforeach
        @if (count($blogs) < 4)
            <script>
                $(document).ready(function(){
                    $('.img1').addClass('img11').removeClass('img1');
                });
            </script>
        @endif
        @else
        <p class="sno">Search found nothing :(</p>
        @endif
        <script>
            function createBlog() {
                window.location.href = "/createblog";
            }
            function showBlog(blogID) {
                window.location.href = "/blog/" + blogID;
            }
            function showCategory() {
                window.location.href = "/category";
            }
        </script>
        {{-- <script>
            if(Cookies.get('isDark') == 'true'){
                // alert("hello")
                document.documentElement.classList.toggle('dark-mode');
                var element = document.getElementById("bswitch");
                if (element.innerHTML == "Light"){
                    element.innerHTML = "Dark";
                }
                else element.innerHTML = "Light";
                document.querySelectorAll('.inverted').forEach(result => {
                        result.classList.toggle('invert');
                });
            }
        </script> --}}
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
