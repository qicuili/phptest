<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="shortcut icon" href="/images/favorite.png?t=2"> -->
    <meta name="keywords" content="@yield('keywords')" />
    <title>@yield('title')|</title>
    <meta name="description" content="@yield('description')| ">
    <meta property="og:type" content="website">
    @yield('head')
    <link rel="stylesheet" href="/css/app.css?t=3">
    @yield('css')
</head>
<body class="w-full overflow-hidden bg-gray-50" data-lang="{{app()->getLocale()}}" data-page="{{$page}}">
    <header class="absolute top-4 left-20 right-20 z-50 h-14  flex flex-row items-center px-10 justify-between bg-white rounded-full shadow-xl text-black">
        <nav class="flex flex-row items-center">
            <a href="/{{app()->getLocale()}}" class="flex flex-row gap-2 items-center">
                <img src="/images/logo.png" class="h-10 w-10 bg-[#BBFB4C]" alt="">
                <span class="text-2xl font-bold">{{trans('message.appname')}}</span>
            </a>
            <ul class="flex flex-row gap-6 ml-10 items-center  text-xl">
                <li class="">
                    <a href="/{{app()->getLocale()}}" class="@if($page=='home') font-bold @else @endif">{{trans('message.home')}}</a>
                </li>
                <li class="">
                    <a href="/{{app()->getLocale()}}/object-deletion" class="@if($page=='delete') font-bold  @else @endif">{{trans('message.delete')}}</a>
                </li>
                <li class="">
                    <a href="/{{app()->getLocale()}}/draw-similarities" class="@if($page=='redraw') font-bold @else @endif">{{trans('message.redraw')}}</a>
                </li>
              
            </ul>
        </nav>
        <div class="flex flex-row gap-2 items-center">
            <span class="flex flex-row gap-1 items-center relative cursor-pointer" id="lanuage_view_local">
                <div class="flex flex-row gap-1 items-center  rounded-full border px-3 h-8 text-lg">
                    <img src="/images/language.svg" alt="" class="w-5 h-5">
                    <p class=" font-bold text-text-color-h1">@if(app()->getLocale() == 'en') En @elseif(app()->getLocale() == 'es') Es @elseif(app()->getLocale() == 'ja') Ja @elseif(app()->getLocale() == 'ko') Ko @elseif(app()->getLocale() == 'zh-CN') zh-CN @else @endif </p>
                </div>
                <div id="language" class="absolute hidden  w-24 right-0 top-8  h-44 px-2 bg-white flex flex-col gap-2 rounded-md shadow-md py-2 justify-center overflow-y-auto">
                    <a class="font-bold hover:text-[#D0F962] text-[#9B9A9A] w-full text-center" href="{{ url('/en'.$route) }}">English</a>
                    <a class="font-bold hover:text-[#D0F962] text-[#9B9A9A] w-full text-center" href="{{ url('/es'.$route) }}">Español</a>
                    <a class="font-bold hover:text-[#D0F962] text-[#9B9A9A] w-full text-center" href="{{ url('/zh-CN'.$route) }}">繁中</a>
                    <a class="font-bold hover:text-[#D0F962] text-[#9B9A9A] w-full text-center" href="{{ url('/ja'.$route) }}">日本語</a>
                    <a class="font-bold hover:text-[#D0F962] text-[#9B9A9A] w-full text-center" href="{{ url('/ko'.$route) }}">한국인</a>
                </div>
            </span>
            @if(Auth::user())
            <span class="flex flex-row gap-1 items-center  text-lg">
                <a href="/{{app()->getLocale()}}/user" class="flex flex-row gap-1">
                    <img src="{{Auth::user()->avator}}" alt="" class="w-8 h-8 rounded-full">
                    <span class="">{{Auth::user()->name}}</span>
                </a>
                <a href="/logout" class="text-red-400 font-bold">{{trans('message.logout')}}</a>
            </span>
            @else
            <a href="/login/google" class="flex  text-lg flex-row gap-2 px-4 py-1 rounded-full bg-[#181818] text-white items-center">
                <span>{{trans('message.login')}}</span>
                <span class="rounded-full flex flex-row w-6 h-6 justify-center items-center bg-[#BBFB4C] text-black">→</span>
            </a>
            @endif
        </div>
    </header>
    <main class="w-full h-screen overflow-y-auto  ">
        <div class="w-full flex flex-col z-10 min-h-screen relative" id="container">
            @yield('content')
         
        </div>
    </main>
    <div id="toast" class="toast bg-blue-500 py-2 px-4 rounded shadow-lg z-50 hidden">
        <span class="text-white" id="msg">This is a toast message!</span>
    </div>
    @yield('alert')
   
</body>
<script src="/js/app.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('lanuage_view_local')) {
            document.getElementById('lanuage_view_local').addEventListener('click', function() {
                var modelsElement = document.getElementById('language');
                modelsElement.classList.toggle('hidden');
            });
            document.getElementById('lanuage_view_local').addEventListener('mouseleave', function() {
                var modelsElement = document.getElementById('language');
                modelsElement.classList.add('hidden');
            });
        }
    })
</script>
@yield('script')
</html>