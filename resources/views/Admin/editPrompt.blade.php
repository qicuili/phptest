@extends('layout.app_admin', ["page" => "prompt"])
@section('title'){{ 'admin' }}@endsection
@section('css')
@endsection
@section("content")
<div class="flex flex-col w-full h-screen-80 px-10 py-10 overflow-y-auto gap-5" id="content_view" @if($prompt) data-id="{{$prompt->id}}" @else data-id="0" @endif>
   <h1 class="text-center text-2xl font-bold">{{$type}} prompt</h1>
   <ul class="flex flex-col gap-3 w-full">
    <li class="flex flex-row gap-1 items-center">
        <span>name(en)</span>
        <input type="text" class="flex-1 border px-3 py-2 rounded-2xl" placeholder="请输入英文名字" @if($prompt) value="{{$prompt->name_en}}" @else @endif>
    </li>
    <li class="flex flex-row gap-1 items-center">
        <span>name(es)</span>
        <input type="text" class="flex-1 border px-3 py-2 rounded-2xl" placeholder="请输入西班牙语名字" @if($prompt) value="{{$prompt->name_es}}" @else @endif>
    </li>
    <li class="flex flex-row gap-1 items-center">
        <span>name(ja)</span>
        <input type="text" class="flex-1 border px-3 py-2 rounded-2xl" placeholder="请输入日语名字" @if($prompt) value="{{$prompt->name_ja}}" @else @endif>
    </li>
    <li class="flex flex-row gap-1 items-center">
        <span>name(ko)</span>
        <input type="text" class="flex-1 border px-3 py-2 rounded-2xl" placeholder="请输入韩语名字" @if($prompt) value="{{$prompt->name_ko}}" @else @endif>
    </li>
    <li class="flex flex-row gap-1 items-center">
        <span>name(zh)</span>
        <input type="text" class="flex-1 border px-3 py-2 rounded-2xl" placeholder="请输入中文名字" @if($prompt) value="{{$prompt->name_zh}}" @else @endif>
    </li>
    <li class="flex flex-row gap-1 items-center">
        <span>prompt(要求为英文)</span>
        <input type="text" class="flex-1 border px-3 py-2 rounded-2xl" placeholder="请输入内置描述词" @if($prompt) value="{{$prompt->content}}" @else @endif>
    </li>
   </ul>
   <button class=" w-full py-2 mt-10 rounded-3xl text-center bg-blue-500" id="submit">提交</button>
</div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded',function(){
        let submit = document.getElementById('submit');
        submit.addEventListener('click',function(){
            let prompt_id = document.getElementById('content_view').getAttribute('data-id')
            let name_en = document.querySelector('input[placeholder="请输入英文名字"]').value;
            let name_es = document.querySelector('input[placeholder="请输入西班牙语名字"]').value;
            let name_ja = document.querySelector('input[placeholder="请输入日语名字"]').value;
            let name_ko = document.querySelector('input[placeholder="请输入韩语名字"]').value;
            let name_zh = document.querySelector('input[placeholder="请输入中文名字"]').value;
            let content = document.querySelector('input[placeholder="请输入内置描述词"]').value;
            let data = {
                id:prompt_id,
               name_en: name_en,
                name_es:name_es,
                name_ja:name_ja,
                name_ko:name_ko,
                name_zh:name_zh,
                content:content
            }
            fetch('/admin/addPrompt_post',{
                method:"POST",
                headers:{
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body:JSON.stringify(data)
            }).then(res=>res.json()).then(res=>{
                if(res.code == 200){
                    alert('添加成功');
                     window.location.href = "/admin/prompt";
                }else{
                    alert('添加失败');
                }
            })
        })

    })

  
</script>

@endsection