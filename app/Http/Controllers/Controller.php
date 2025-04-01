<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function requestData($url,$request_type,$headers,$data){
        $url = $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if($request_type == 'POST'){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }else if($request_type == 'GET'){
            curl_setopt($ch, CURLOPT_HTTPGET, true); 
        }
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }
        if (curl_errno($ch)) {
            return ['code' => 404, 'data' => '', 'msg' => curl_error($ch)];
        } else {
            // 解析响应
           
            if (json_last_error() === JSON_ERROR_NONE) {
               
                $responseData = json_decode($response, true); // 假设响应是 JSON 格式
                if($responseData){
                    return ['code' => 200, 'data' => $responseData, 'msg' => ''];

                }else{
                    return ['code' => 200, 'data' => '', 'msg' => $response];
                }
               
            } else {
                return ['code' => 404, 'data' => '', 'msg' => 'Error decoding JSON response: ' . json_last_error_msg()];
            }
        }

        curl_close($ch);
    }
}
