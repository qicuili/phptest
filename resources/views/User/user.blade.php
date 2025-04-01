@extends('layout.app_sam', ["page" => "user"])
@section('keywords'){{'xxx'}}@endsection
@section('title'){{ 'xxx' }}@endsection
@section('description'){{ 'xxx' }}@endsection
@section('css')
@endsection
@section("content")
<div class=" w-full  text-black h-screen-80 px-20 flex py-5 flex-col overflow-y-auto " id="content_view" data-lang="{{app()->getLocale()}}">
   <h1 class="hidden">个人中心</h1>
   <h3 class="hidden"></h3>
   @if(count($inputs)>0)
   <ul class="flex flex-col py-10 w-full gap-4">
      @foreach($inputs as $input)
      <li class="w-full flex flex-col border rounded-2xl py-3 bg-gray-200 ">
         <a href="@if($input->type == 'repaint')/{{app()->getLocale()}}/partial-redraw/{{$input->uuid}}@elseif($input->type=='delete')/{{app()->getLocale()}}/object-deletion/{{$input->uuid}}@elseif($input->type=='redraw')/{{app()->getLocale()}}/draw-similarities/{{$input->uuid}}@else @endif" href="/object-deletion/{{$input->uuid}}" class="flex flex-row w-full justify-between px-5 items-center">
            <div class="flex flex-row gap-3 items-center">
               <span>@if($input->type == "repaint")局部重绘 @elseif($input->type=="delete") 物件删除 @elseif($input->type=="redraw") 画相似 @else @endif</span>
               <img src="{{asset('storage/uploads/'.$input->picture_name)}}" alt="" class="w-20 object-contain">
            </div>
            <div class="flex flex-row gap-2 items-center">
               <p>此图共生成{{count($input->outputpictures)}}个作品</p>
               <button class="@if(count($input->outputpictures) == 0) hidden @else @endif px-5 py-2 rounded-2xl" onclick="getDetail()">查看详情</button>
            </div>
            <div class="flex flex-row gap-2">
               <span>{{$input->created_at}}</span>
            </div>
         </a>
         @if(count($input->outputpictures)>0)
         <ol class="bg-gray-100 flex w-1/2  flex-col self-center px-2 py-2 rounded-3xl" id="detailview">
            @foreach($input->outputpictures as $key=>$output)
            <li class="flex flex-row items-center border-b-2 gap-2 ">
               <span>作品:{{$key+1}}</span>
               <img src="{{asset('storage/uploads/'.$output->origin_image)}}" alt="" class="w-20 object-contain">
               @if($input->type == "redraw")
               <span>=></span>
               @else
               <span>+</span>
               <img src="{{asset('storage/masks/'.$output->image_mask)}}" alt="" class="w-20 object-contain">
               <span>=</span>
               @endif
               <img src="{{$output->picture_name}}" alt="" class="w-20 object-contain">
            </li>
            @endforeach
         </ol>
         @endif
      </li>
      @endforeach
   </ul>
   <div class="flex justify-center px-10  h-10 items-center  self-end w-full" id="paging">
      {{ $inputs -> appends(request()->input()) -> links('pagination::bootstrap-4') }}
   </div>
</div>
@else
@endif
</div>
@endsection
@section("script")
<script>
   document.onload(function() {

   });
</script>
@endsection