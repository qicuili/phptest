<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/images/favorite.png?t=2" type="image/x-icon">
    <meta name="keywords" content="xxx" />
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta property="og:type" content="website">
    @yield('head')
    <link rel="stylesheet" href="/css/app.css?t=1">
   <style>
   </style>
     @yield('css')
</head>
<body class="w-full h-screen bg-bg-color" data-lang="{{app()->getLocale()}}">
    <div class="w-full h-screen  lg:flex lg:flex-row flex-col ">
        <div class="flex-1  relative">
            <div class="lg:h-screen h-screen-40 w-full flex flex-col pt-5 pb-10  gap-5  lg:px-20 px-2 overflow-y-auto">    
                @yield('content')   
            </div>   
        </div>
    </div>   
</body>
@yield('script')
</html>