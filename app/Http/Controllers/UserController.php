<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users/index', compact('users'));
    }

    public function store(UserCreateRequest $request)
    {
        $this->validate($request, [
            'name' => 'required|max:10',
            'email' => 'required|email:rfc,dns|unique:users'
        ]);

        //或者使用数组而不是 | 分割
        $this->validate($request, [
            'name' => ['required', 'max:10'],
            'email' => ['required', 'email:rfc,dns', 'unique:users']
        ]);

        // 接受第三个参数，自定义错误提示
        $this->validate($request, [
            'name' => ['required', 'max:10'],
            'email' => ['required', 'email:rfc,dns', 'unique:users']
        ], [
            'name.required' => '用户名不能为空',
            'name.max' => '用户名不能超过10个字符',
            'email.required' => '邮箱不能为空',
            'email.email' => '不是有效的邮箱',
            'email.unique' => '该邮箱已注册'
        ]);

        // 如果参数不做任何处理
        // 需要在 User 模型中指定 $fillable
        User::create($request->except('_token'));

        // 或者
        // 需要对参数进行处理，比如加密
        // 需要在 User 模型中指定 $fillable
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);

        // 或者
        // 需要对参数进行处理，比如加密
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function show($id)
    {
        $user = User::find($id);

        return $user->profile;
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        //
    }

    public function profile(Request $request)
    {
        // 做法 1
        $user = User::find(1);

        $user->profile()->create([
            'gender' => '男',
            'bio' => '哈哈~'
        ]);


        // 做法 2
        $user = User::find(1);

        $profile = new Profile([
            'gender' => '男',
            'bio' => '哈哈~'
        ]);

        $user->profile()->save($profile);

        // 做法 3
        $user = User::find(1);
        $profile = new Profile();
        $profile->gender = '男';
        $profile->bio = '哈哈~';
        $profile->user()->associate($user);
        $profile->save();
    }

    public function avatar(Request $request)
    {
        /*
         * store 方法：
         * 参数1：指定目录
         * 参数2：指定驱动
         *
         * 该方法将生成一个唯一的 ID 作为文件名
         *
         * 文件存储在 storage/app/public/avatars/ 目录下
         */
        $path = $request->file('avatar')->store('avatars', 'public');

        /*
         * store 方法：
         * 参数1：指定目录
         * 参数2：指定文件名
         * 参数3：指定驱动
         *
         * 文件存储在 storage/app/public/avatars/ 目录下
         */
        $path = $request->file('avatar')->storeAs('avatars', Str::random().'.jpg','public');


        $path = Storage::putFile('avatars', $request->file('avatar'), 'public');

        $path = Storage::putFileAs('avatars', $request->file('avatar'), Str::random().'.jpg', 'public');


        $url = Storage::disk('public')->url($path);
    }
}
