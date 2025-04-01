@extends('layout.app_admin', ["page" => "prompt"])
@section('title'){{ 'admin' }}@endsection
@section('css')
@endsection
@section("content")
<div class="flex flex-col w-full h-screen-80 px-10 py-10 overflow-y-auto gap-5" id="content_view" @if($example) data-id="{{$example->id}}" @else data-id="0" @endif>
    <h1 class="text-center text-2xl font-bold">{{$type}} 示例图片</h1>
    <ul class="flex flex-col gap-3 w-full">
        <li class="flex flex-row gap-1 items-center">
            <span>功能</span>
            <select name="" id="function">
                <option value="repaint" @if($example&&$example->type=="repaint") selected @else @endif>局部重绘</option>
                <option value="delete" @if($example&&$example->type=="delete") selected @else @endif>物件删除</option>
                <option value="redraw" @if($example&&$example->type=="redraw") selected @else @endif>画相似</option>
            </select>
        </li>
        <li class="flex flex-row gap-1 items-center">
            <span>原图</span>
            <img src="@if($example&&!empty($example->picture_name)){{asset('storage/examples/'.$example->picture_name)}} @else @endif" alt="" class="w-10 h-10">
            <input type="file" id="chooseOrigin" onchange="chooseOrigin()">
        </li>
        <li class="flex flex-row gap-1 items-center">
            <span>示例图1</span>
            <img src="@if($example&&!empty($example->example1)){{asset('storage/examples/'.$example->example1)}} @else @endif" alt="" class="w-10 h-10">
            <input type="file" id="chooseExample1" onchange="chooseExample1()">
        </li>
        <li class="flex flex-row gap-1 items-center">
            <span>示例图2</span>
            <img src="@if($example&&!empty($example->example2)){{asset('storage/examples/'.$example->example2)}} @else @endif" alt="" class="w-10 h-10">
            <input type="file" id="chooseExample2" onchange="chooseExample2()">
        </li>
        <li class="flex flex-row gap-1 items-center">
            <span>示例图3</span>
            <img src="@if($example&&!empty($example->example3)){{asset('storage/examples/'.$example->example3)}} @else @endif" alt="" class="w-10 h-10">
            <input type="file" id="chooseExample3" onchange="chooseExample3()">
        </li>

    </ul>
    <button class=" w-full py-2 mt-10 rounded-3xl text-center bg-blue-500" id="submit">提交</button>
</div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let submit = document.getElementById('submit');
        submit.addEventListener('click', function() {
            let example_id = document.getElementById('content_view').getAttribute('data-id')
            let fomadata = new FormData()
            fomadata.append('example_id', example_id)
            fomadata.append('origin', document.getElementById('chooseOrigin').files[0])
            fomadata.append('example1', document.getElementById('chooseExample1').files[0])
            fomadata.append('example2', document.getElementById('chooseExample2').files[0])
            fomadata.append('example3', document.getElementById('chooseExample3').files[0])
            fomadata.append('type', document.getElementById('function').value)
            fetch('/admin/addExample_post', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: fomadata
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    if (data.code == '200') {
                        toast(data.msg)
                        setTimeout(function() {
                            window.location.href = '/admin/examplePictures'
                        }, 1000)

                    } else {
                        toast(data.msg)
                    }
                })

        })

    })

    function chooseOrigin() {
        let file = document.getElementById('chooseOrigin').files[0];
        let img = document.getElementById('chooseOrigin').parentElement.querySelector('img');
        let reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }

    function chooseExample1() {
        let file = document.getElementById('chooseExample1').files[0];
        let img = document.getElementById('chooseExample1').parentElement.querySelector('img');
        let reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }

    function chooseExample2() {
        let file = document.getElementById('chooseExample2').files[0];
        let img = document.getElementById('chooseExample2').parentElement.querySelector('img');
        let reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }

    function chooseExample3() {
        let file = document.getElementById('chooseExample3').files[0];
        let img = document.getElementById('chooseExample3').parentElement.querySelector('img');
        let reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
</script>

@endsection