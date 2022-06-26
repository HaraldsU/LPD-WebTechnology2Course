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
        {{-- @foreach ($blog as $blog1)
            {{$blog1}}
        @endforeach --}}
        @foreach ($blog as $blog1)
        <form method="POST" action="{{action([App\Http\Controllers\BlogController::class, 'update'], $blog1->id)}}" id="blogform">
            <input type="text" name="name" placeholder="{{$blog1->name}}">
            <br>
            <br>
            <textarea type="text" name="content" placeholder="{{$blog1->content}}" id="content" class="content"></textarea>
            <br>
            <br>
            <input type="text" name="link" placeholder="{{$blog1->link}}">
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
                    <option value="" disabled selected>Keyword1 (can be empty)</option>
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
                    <option value="" disabled selected>Keyword2 (can be empty)</option>
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
                    <option value="" disabled selected>Keyword3 (can be empty)</option>
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
                    <option value="" disabled selected>Keyword4 (can be empty)</option>
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
                    <option value="" disabled selected>Keyword5 (can be empty)</option>
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
                    <option value="" disabled selected>Blog Category (can be empty)</option>
                    @endif
                {{-- @endforeach --}}
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->id}}</option>
                @endforeach
            </select>
            <br>
            <br>
            <input type="submit" value="Edit Blog" id="blogadd">
        </form>
        @endforeach
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