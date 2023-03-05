<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 根据情况使用下列的任意一个
        // 所有方法都需要认证
        $this->middleware('auth');
        // 指定需要认证的方法
        $this->middleware('auth', ['only'=>[]]);
        // 指定不需要认证的方法
        $this->middleware('auth', ['except' => []]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function authUser(Request $request){

        // 获取当前的认证用户信息 ...
        $user = Auth::user();
        // 或者
        $user = \auth()->user();
        // 或者
        $user = $request->user();

        // 获取当前的认证用户id ...
        $id = Auth::id();
        // 或者
        $id = \auth()->id();
    }

    public function scanLogin($token){
        // 假设用户表中有个 wechat_token 字段，保存微信登录的 token
        $user = User::where('wechat_token', $token)->first();

        Auth::login($user);
        // 或者
        \auth()->login($user);
        // 或者
        Auth::loginUsingId($user->id);
        // 或者
        \auth()->loginUsingId($user->id);
    }
}
