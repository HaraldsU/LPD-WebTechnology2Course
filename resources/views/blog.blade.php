<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>lpdhu21001</title>
    <meta name="description" content="description"/>
    <meta name="author" content="author" />
    <meta name="keywords" content="keywords" />
    <link rel="stylesheet" href="<?php echo asset('css/landing.css')?>" type="text/css">
    <meta charset="UTF-8"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>
  <body>
    <section id="first">
            <div class="login">
                <a id="home" class="login-text" href="{{url('/')}}">{{__('Home')}}</a>
                @if (Auth::check())
                    <p class="login-text" id="log-user">{{__('User')}}:&nbsp;&nbsp;<i>{{Auth::user()->name}}</i></p>
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
                        <a href="{{ url('/logout') }}" id="logout">{{__('Logout')}}</a>
                    @else
                        <a href="{{ route('login') }}" class="login-text">{{__('Log in')}}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="login-text">{{__('Register')}}</a>
                        @endif
                     @endauth
                </div>
                @endif
            </div>
    </section>
    <section id="second">
        <div class="right">
            <p id="switch">{{__('Theme')}}: <button id="bswitch" class="switch" tabindex="0">{{__('Dark')}}</button></p>
            {{-- <form type="POST" action="{{url('/search')}}">
                <input type="search" placeholder="Make a search" name="name">
                <button type="Submit">Search</button>
            </form> --}}
            <button onclick="showCategory()" id="blogc">{{__('Blog Categories')}}</button>
            @foreach ($blog as $blog1)
                <button onclick="editBlog({{$blog1->id}})" id="blogedit" name="blogedit">{{__('Edit')}}</button>
            @endforeach
            <div class = "ddel">
                @if($errors->has('blogedit'))
                    @foreach ($errors->all() as $error)
                        <p class="error-del">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
            @foreach ($blog as $blog1)
                <button onclick="deleteBlog({{$blog1->id}})" id="blogdel" name="blogdel">{{__('Delete')}}</button>
            @endforeach
            <div class = "ddel">
                @if($errors->has('blogdel'))
                    @foreach ($errors->all() as $error)
                        <p class="error-del">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <script>
        function showCategory() {
            window.location.href = "/category";
        }
        function deleteBlog(blogID) {
            window.location.href = "/blog/delete/" + blogID;
        }
        function editBlog(blogID) {
            window.location.href = "/blog/edit/" + blogID;
        }
    </script>
    <section id="third3">
        {{-- {{$blog}} --}}
        @foreach ($blog as $blog1)
        <div id="blogd">
            <h1 id="blogh">{{$blog1->name}}</h1>
            <img id="blogi" class="image inverted" src="{{$blog1->link}}">
            <p class="bloginfo"><b>{{__('Author')}}:</b> {{$author->name}}</p>
            <p class="bloginfo"><b>{{__('Date')}}:</b> {{$blog1->created_at->format('d/m/y H:i')}}</p>
            <p id="blogp">{!!nl2br($blog1->content)!!}</p>
        </div>
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
        {{-- {{$blog->id}} --}}
        {{-- <h1 class="imgt">{{$blog->name}}</h1> --}}
    </section>
    <section id="validate">
    </section>
    @if (session()->has('message'))
        <script>
            error = {!! str_replace("'", "\'", json_encode(session('message'))) !!};
            alert(error);
        </script>
    @endif
    <section class="comments">
        <div id="commentbox">
            <h3 id="makecom">{{__('Comment')}}<h3>
            <form method="POST" action="{{action([App\Http\Controllers\CommentController::class, 'store'])}}">
                @csrf
                @if (!$errors->has('blogedit') and !$errors->has('blogdel'))
                    <div class="danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <textarea id="cbox" type="text" name="comment"></textarea>
                <input type="submit" value="{{__('Post Comment')}}" id="cadd">
                @foreach ($blog as $blog1)
                    <input type="hidden" value="{{$blog1->id}}" name="blog">
                @endforeach
            </form>
        </div>
    </section>
    <script>
        $(document).on('click', 'textarea', function(){
            $('.danger').remove();
        });
    </script>
    {{-- {{$users}} --}}
    {{-- {{$comments}} --}}
    @if (count($comments) > 0)
    <section id="fcom">
        @foreach ($comments as $comment)
        <section class="comments">
            <div class="imgtext">
                <img id="pimg" src="data:image/png;base64,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">
                @foreach ($users as $user)
                @if ($comment->user == $user->id)
                <h4 id="pname">{{$user->name}}</h4>
                <p id="comment-time">{{$comment->created_at->format('d/m/y H:i');}}</p>
                @break
                @endif
                @endforeach
            </div>
            <div class="usercomment">
                <p class="comtext" id="com">{{$comment->comment}}</p>
                @php
                    $user = Auth::user();
                @endphp
                @if ($user->id == $comment->user or $user->isAdmin == true)
                <input type="button" value="{{__('Delete Comment')}}" id="cadd1" onclick="deleteComment({{$comment->id}})">
                @endif
            </div>
        </section>
        @endforeach
        @endif
        <script>
            function deleteComment(commentID){
                window.location.href = "/comment/delete/" + commentID;
            }
        </script>
    </section>
    <section id='end'></section>
  </body>
</html>
