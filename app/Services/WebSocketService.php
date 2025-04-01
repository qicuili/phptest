<?php
   namespace App\Services;

   use WebSocket\Client; // 引入WebSocket客户端类

   class WebSocketService
   {
       protected $wsUrl;

       public function __construct()
       {
           $this->wsUrl = 'ws://192.168.11.128:7871/ws'; // WebSocket服务器URL
       }

       public function sendMessage($clientId)
       {
           try {
               $client = new Client($this->wsUrl); // 创建WebSocket客户端对象

               $message = json_encode(['clientId' => $clientId]);

               // 向WebSocket服务器发送消息
               $client->send($message);

               // 接收来自WebSocket服务器的响应消息
               $response = $client->receive();

               $client->close(); // 关闭连接

               return $response;
           } catch (\Exception $e) {
               // 处理异常
               return "Error: " . $e->getMessage();
           }
       }
   }
