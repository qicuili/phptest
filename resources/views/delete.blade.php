@extends('layout.app', ["page" => $page])
@section('keywords'){{'xxx'}}@endsection
@section('title'){{ 'xxx' }}@endsection
@section('description'){{ 'xxx' }}@endsection
@section('css')
@endsection
@section("content")
<div class=" w-full pt-32  px-32" id="content_view" data-lang="{{app()->getLocale()}}" @if(Auth::user()) data-login="true" @else data-login="false" @endif>
    <div id="chat-container">
        <!-- 聊天消息显示区域 -->
        <div id="chat-messages"></div>
        <!-- 加载条 -->
        <div id="loading-bar" class="hidden bg-blue-500 h-2 w-0 mb-2 rounded"></div>
        <!-- 输入框和发送按钮 -->
        <div class="flex mt-4">
            <input type="text" id="chat-input" class="flex-1 border border-gray-300 p-2 rounded-l" placeholder="输入你的问题">
            <button id="send-button" class="bg-blue-500 text-white px-4 py-2 rounded-r">发送</button>
        </div>
    </div>
</div>
@endsection
@section("script")
<script>
    // 获取聊天消息显示区域、输入框、发送按钮和加载条的 DOM 元素
    const chatMessages = document.getElementById('chat-messages');
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-button');
    const loadingBar = document.getElementById('loading-bar');

    // 为发送按钮添加点击事件监听器
    sendButton.addEventListener('click', function() {
        // 获取输入框中的问题
        const question = chatInput.value;
        if (question.trim() === '') return;
        // 显示用户的问题
        displayMessage('你', question);
        // 显示加载条
        loadingBar.classList.remove('hidden');
        let width = 0;
        const interval = setInterval(() => {
            if (width >= 100) {
                clearInterval(interval);
                loadingBar.classList.add('hidden');
            } else {
                width++;
                loadingBar.style.width = width + '%';
            }
        }, 20);

        // 模拟一个简单的答案
        const answer = '这是一个简单的答案。';
        setTimeout(() => {
            // 显示答案
            displayMessage('机器人', answer);
            // 清空输入框
            chatInput.value = '';
        }, 2000);
    });

    // 显示消息的函数
    function displayMessage(sender, message) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('mb-2');
        messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
        chatMessages.appendChild(messageElement);
    }
</script>
@endsection