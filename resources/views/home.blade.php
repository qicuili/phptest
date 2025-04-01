@extends('layout.app', ["page" => $page])
@section('keywords'){{'xxx'}}@endsection
@section('title'){{ 'xxx' }}@endsection
@section('description'){{ 'xxx' }}@endsection
@section("content")
<div class="w-full pt-40 px-40 " id="content_view" data-lang="{{app()->getLocale()}}" @if(Auth::user()) data-login="true" @else data-login="false" @endif>
    <!-- 当前天气主卡片 -->
    <div class="flex flex-col md:flex-row gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-lg flex-1">
            <div class="flex items-center gap-4">
                <div class="text-6xl">🌤️</div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">北京市</h2>
                    <p class="text-gray-600">晴间多云 25°C</p>
                </div>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-4">
                <div class="flex items-center">
                    <span class="text-sm text-gray-600 mr-2">体感温度</span>
                    <span class="font-semibold">27°C</span>
                </div>
                <div class="flex items-center">
                    <span class="text-sm text-gray-600 mr-2">紫外线</span>
                    <span class="font-semibold">中等</span>
                </div>
            </div>
        </div>

        <!-- 天气指标 -->
        <div class="bg-gray-50 rounded-2xl p-6 shadow-lg w-full md:w-64">
            <div class="space-y-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">风速</span>
                    <span class="font-semibold">12 km/h</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">湿度</span>
                    <span class="font-semibold">65%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 逐小时预报 -->
    <div class="mb-8 overflow-x-auto pb-4">
        <div class="flex gap-4">
            @foreach(range(0, 23, 3) as $hour)
            <div class="bg-white rounded-xl p-4 shadow-md min-w-[120px] text-center">
                <p class="text-gray-600 mb-2">{{ $hour }}:00</p>
                <div class="text-3xl mb-2">🌤️</div>
                <p class="font-semibold">{{ 24 + $hour }}°C</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- 七日预报 -->
    <div class="bg-white rounded-2xl p-6 shadow-lg">
        <h3 class="text-xl font-semibold mb-4">七日预报</h3>
        <div class="space-y-3">
            @foreach(['周一','周二','周三','周四','周五','周六','周日'] as $day)
            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                <span class="text-gray-600">{{ $day }}</span>
                <div class="flex items-center gap-4">
                    <span class="text-gray-600">🌙 18°C</span>
                    <span class="text-gray-800 font-semibold">☀️ 28°C</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- 添加按钮 -->
    <button id="open-modal-button" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">打开弹框</button>
    <!-- 弹框 -->
    <div id="modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-2xl font-bold mb-4">这是一个弹框</h2>
            <p>这是弹框的内容。</p>
            <button id="close-modal-button" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">关闭弹框</button>
        </div>
    </div>
</div>
@endsection
@section("script")
<script>
    // 获取打开弹框按钮、关闭弹框按钮和弹框的 DOM 元素
    const openModalButton = document.getElementById('open-modal-button');
    const closeModalButton = document.getElementById('close-modal-button');
    const modal = document.getElementById('modal');

    // 为打开弹框按钮添加点击事件监听器
    openModalButton.addEventListener('click', function() {
        // 显示弹框
        modal.classList.remove('hidden');
    });

    // 为关闭弹框按钮添加点击事件监听器
    closeModalButton.addEventListener('click', function() {
        // 隐藏弹框
        modal.classList.add('hidden');
    });
</script>
@endsection