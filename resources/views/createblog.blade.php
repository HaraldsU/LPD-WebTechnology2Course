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
                <div class="login2">
                    @auth
                        <a href="{{ url('/logout') }}" id="logout">Logout</a>
                    @endauth
                </div>
            </div>
    </section>
    <section id="second">
        <div class="right">
            <p id="switch">Theme: <button id="bswitch" class="switch" tabindex="0">Dark</button></p>
            <button onclick="showCategory()" id="blogc">Blog Categories</button>
            <script>
                function showCategory() {
                    window.location.href = "/category";
                }
            </script>
        </div>
    </section>
    <section id="third3">
        <form method="POST" action="{{action([App\Http\Controllers\BlogController::class, 'store']) }}" id="blogform">
            @csrf
            <input type="text" name="name" placeholder="Blog Name">
            <br>
            <br>
            <textarea type="text" name="content" placeholder="Blog Content" id="content" class="content"></textarea>
            <br>
            <br>
            <input type="text" name="link" placeholder="Image Link">
            <br>
            <br>
            {{-- <input type="text" name="keyword1" placeholder="Keyword1 (can be empty)"> --}}
            {{-- @foreach ($keywords as $keyword)
            {{$keyword->id}}
            {{$keyword}}
            @endforeach --}}
            <select name="keyword1">
                <option value="" disabled selected>Keyword1 (can be empty)</option>
                @foreach ($keywords as $keyword)
                    <option value="{{$keyword->id}}">{{$keyword->id}}</option>
                @endforeach
            </select>
            <br>
            <br>
            <select name="keyword2">
                <option value="" disabled selected>Keyword2 (can be empty)</option>
                @foreach ($keywords as $keyword)
                    <option value="{{$keyword->id}}">{{$keyword->id}}</option>
                @endforeach
            </select>
            <br>
            <br>
            <select name="keyword3">
                <option value="" disabled selected>Keyword3 (can be empty)</option>
                @foreach ($keywords as $keyword)
                    <option value="{{$keyword->id}}">{{$keyword->id}}</option>
                @endforeach
            </select>
            <br>
            <br>
            <select name="keyword4">
                <option value="" disabled selected>Keyword4 (can be empty)</option>
                @foreach ($keywords as $keyword)
                    <option value="{{$keyword->id}}">{{$keyword->id}}</option>
                @endforeach
            </select>
            <br>
            <br>
            <select name="keyword5">
                <option value="" disabled selected>Keyword5 (can be empty)</option>
                @foreach ($keywords as $keyword)
                    <option value="{{$keyword->id}}">{{$keyword->id}}</option>
                @endforeach
            </select>
            <br>
            <br>
            {{-- <input type="text" name="category_id" placeholder="Blog Category (can be empty)"> --}}
            <select name="category_id">
                <option value="" disabled selected>Blog Category (can be empty)</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->id}}</option>
                @endforeach
            </select>
            <br>
            <br>
            <input type="submit" value="Make Blog" id="blogadd">
        </form>
        <script>
            if (getCookie('theme') == null){
                // alert("null");
                setCookie('theme', 'light');
           }
            if (getCookie('theme') == "dark"){;
                    var element = document.getElementById("bswitch");
                    element.innerHTML = "Dark";
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
    </section>
  </body>
</html>
