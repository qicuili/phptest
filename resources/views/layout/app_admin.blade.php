<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:type" content="website">
    @yield('head')
    <link rel="stylesheet" href="/css/app.css?t=1">
    <style>
        .toast {
            position: fixed;
            top: 40px;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
    @yield('css')
</head>
<body class="w-full bg-gray-50" data-lang="{{app()->getLocale()}}" data-page="{{$page}}">
    <header class=" h-20 bg-white w-full flex flex-row justify-between items-center px-5">
        <a href="/{{app()->getLocale()}}" class="flex flex-row gap-2 items-center">
            <img src="/images/logo.png" class="h-10 w-10 bg-[#BBFB4C]" alt="">
            <span class="text-2xl font-bold">{{trans('message.appname')}}</span>
        </a>
        <span class="text-3xl">后台管理系统</span>
        <span class="flex flex-row gap-1 items-center  text-lg">
            <img src="{{Auth::user()->avator}}" alt="" class="w-8 h-8 rounded-full">
            <span class="">{{Auth::user()->name}}</span>
            <a href="/logout" class="text-red-400 font-bold">{{trans('message.logout')}}</a>
        </span>
    </header>
    <main class="w-full h-screen-80 flex flex-row ">
        <aside class="flex w-1/5 h-screen-80  flex-col justify-center items-center bg-gray-200">
            <ul class="flex flex-col gap-5">
                <li>
                    <a href="/admin">首页</a>
                </li>
            </ul>
        </aside>
        <div class="flex-1 h-screen-80">
            @yield('content')
        </div>
    </main>
    <div id="toast" class="toast bg-blue-500 py-2 px-4 rounded shadow-lg hidden">
        <span class="text-white" id="msg">This is a toast message!</span>
    </div>
</body>
<script src="/js/app.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    })
</script>
@yield('script')
</html>