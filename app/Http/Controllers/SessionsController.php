<?php

namespace App\Http\Controllers;

use vendor\mews\captcha\src\Captcha;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;	

class SessionsController extends Controller
{
	public function create()
    {
    	if(Auth::check()){
    		return redirect('topics');
    	}
        return view('sessions.create');
    }

    public function store(Request $request)
    {
       $this->validate($request, [
           'email' => 'required|email|max:255',
           'password' => 'required',
           'captcha' => 'required|captcha',
       ],[
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
       ]);
       $credentials = $this->validate($request, [
           'email' => 'required|email|max:255',
           'password' => 'required',
       ]);

       if (Auth::attempt($credentials, $request->has('remember'))) {
       	    if(Auth::user()->activated) {
               session()->flash('success', '欢迎回来！');
               return redirect()->intended(route('users.show', [Auth::user()]));
           	} else {
               Auth::logout();
               session()->flash('warning', '你的账号未激活，请检查邮箱中的注册邮件进行激活。');
               return redirect('/');
          	}

       } else {
           session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
           return redirect()->back();
       }
    }

	public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }

	public function getCaptcha(Captcha $captcha, $config = 'default')
	{
		ob_clean();
		return $captcha->create($config);
	}
}