@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="<?php echo asset('css/landing.css')?>" type="text/css">
<script>
    if (getCookie('theme') == null){
        // alert("null");
        setCookie('theme', 'light');
   }
    if (getCookie('theme') == "dark"){;
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
