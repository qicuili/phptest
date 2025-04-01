@extends('layout.app', ["page" => $page])
@section('keywords'){{'xxx'}}@endsection
@section('title'){{ 'xxx' }}@endsection
@section('description'){{ 'xxx' }}@endsection
@section('css')
@endsection
@section("content")
<div class=" w-full pt-32 " id="content_view" data-lang="{{app()->getLocale()}}" @if(Auth::user()) data-login="true" @else data-login="false" @endif>
   第三页
</div>
@endsection
@section("script")
<script>
   
</script>
@endsection