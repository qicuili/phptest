<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index()
    {
        return view('User.login',[
            'route'=>"/login"
        ]);
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function loginCallback(Request $request)
    {

        $preAuthCode = $request->input("code");
        $response = Http::withHeaders([
            "Authorization" => "app_access_token",
            'Content-Type' => 'application/json; charset=utf-8'
        ])->post('https://passport.feishu.cn/suite/passport/oauth/token', [
            'grant_type' => "authorization_code",
            "client_id" => env("FEISHU_APP_ID", ""),
            "client_secret" => env("FEISHU_APP_SECRET", ""),
            "code" => $preAuthCode,
            "redirect_uri" => env('FEISHU_REDIRECT_URI', '')
        ]);
        Log::info("loginCallback " . $response);
        $jsonRet = json_decode($response);

        if (!$jsonRet) {
            return "登录失败，请联系管理员";
        }
        if (isset($jsonRet->error)) {
            return "登录失败";
        }
        $access_token = $jsonRet->access_token;
        $userInfo = Http::withHeaders([
            "Authorization" => "Bearer {$access_token}"
        ])->get('https://passport.feishu.cn/suite/passport/oauth/userinfo');
        $jsonUserInfo = json_decode($userInfo);
        $name = $jsonUserInfo->name;
        $user = User::where('name', $name)->first();
        if (!$user) {
            // 如果用户不存在，创建一个新用户
            $user = User::create([
                'name' => $jsonUserInfo->name,
                'email' => "",
                'open_id' => $jsonUserInfo->open_id,
                'ip' => request()->ip(),
                'avator' => $jsonUserInfo->avatar_url,

            ]);
        }
        Auth::login($user);
        return redirect('/');
    }
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // 找到或创建用户
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // 如果用户不存在，创建一个新用户
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'open_id' => $googleUser->getId(),
                'ip' => request()->ip(),
                'avator' => $googleUser->getAvatar(),

            ]);
        }
        // 登录用户
        Auth::login($user);
        return redirect('/'); // 登录后重定向的路径
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
