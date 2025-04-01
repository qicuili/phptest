@extends('layout.app_admin', ["page" => "prompt"])
@section('title'){{ 'admin' }}@endsection
@section('css')
@endsection
@section("content")
<div class="flex flex-col w-full gap-3 h-screen-80 px-10 py-10 overflow-y-auto gap-3">
    <ul class="flex flex-col w-full border">
        <li class="flex flex-row w-full items-center bg-blue-300 py-2">
            <span class="flex-1 text-center">name_en</span>
            <span class="flex-1 text-center">name_en</span>
            <span class="flex-1 text-center">name_en</span>
            <span class="flex-1 text-center">name_en</span>
            <span class="flex-1 text-center">name_en</span>
            <span class="flex-1 text-center">内置prompt</span>
            <span class="flex-1 text-center">编辑</span>

        </li>
        @foreach($prompts as $prompt)
        <li class="flex flex-row w-full items-center border-b py-2" data-id="{{$prompt->id}}">
            <span class="flex-1 text-center">{{$prompt->name_en}}</span>
            <span class="flex-1 text-center">{{$prompt->name_es}}</span>
            <span class="flex-1 text-center">{{$prompt->name_ja}}</span>
            <span class="flex-1 text-center">{{$prompt->name_ko}}</span>
            <span class="flex-1 text-center">{{$prompt->name_zh}}</span>
            <span class="flex-1 text-center">{{$prompt->content}}</span>
            <span class="flex-1 text-center flex flex-row gap-4">
                <a href="/admin/editPrompt?id={{$prompt->id}}" class="text-blue-400">编辑</a>
                <span id="delete" class="text-red-500 cursor-pointer">删除</span>
            </span>

        </li>
        @endforeach
    </ul>
    <a href="/admin/editPrompt" class="bg-blue-500 px-5 py-2 self-start rounded-2xl">添加</a>


</div>


@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('#delete').forEach(function(item) {
            item.addEventListener('click', function() {
                if (!confirm("确认清除，清除后不可恢复？")) { return; }
                let id = item.parentElement.parentElement.getAttribute('data-id')
                fetch('/admin/deletePrompt', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        id: id
                    })
                }).then(res => res.json()).then(res => {
                    if (res.code == 200) {
                        item.parentElement.parentElement.remove()
                    }
                })
            })
        })
    })
</script>

@endsection