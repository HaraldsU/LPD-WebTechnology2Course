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
                @foreach ($users as $user)
                @if ($comment->user == $user->id)
                <img id="pimg" class="image inverted" src='{{url('storage/images/'.$user->file_path)}}'>
                <h4 id="pname">{{$user->name}}</h4>
                <p id="comment-time">{{$comment->created_at->format('d/m/y H:i');}}</p>
                @break
                @endif
                @endforeach
            </div>
            <div class="usercomment">
                <p class="comtext" id="com">{{$comment->comment}}</p>
                @if (!Auth::guest())
                    @php
                        $user = Auth::user();
                    @endphp
                    @if ($user->id == $comment->user or $user->isAdmin == true)
                    <input type="button" value="{{__('Delete Comment')}}" id="cadd1" onclick="deleteComment({{$comment->id}})">
                    @endif
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
    <section id='end'></section>
  </body>
</html>
