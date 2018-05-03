@extends('layouts.app')
@section('title', '登录')

@section('content')


    <div class="col-md-offset-3 col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h5>登录</h5>
        </div>
        <div class="panel-body">
          @include('common.error')

          <form method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}

              <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">邮箱：</label>
                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
              </div>

              <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">密码：</label>
                <input type="password" name="password" class="form-control" value="{{ old('password') }}">
              </div>
              <label><input type="checkbox" name="remember"> 记住我</label>
              <hr style="margin: 8px 0">
              <div class="form-group {{ $errors->has('captcha') ? ' has-error' : '' }}">
              
                <div class="col-md-6 ">
                    <label for="captcha">验证码:</label>

                    <input id="captcha" class="form-control" name="captcha" >

                    @if ($errors->has('captcha'))
                        <span class="help-block">
                            <strong>{{ $errors->first('captcha') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-6" style="padding-top: 12px">
                        <div class="col-md-6  register">
                          <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                        </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block">登录</button>


          </form>

          <hr style="margin: 8px 0">

          <p>还没账号？<a href="{{ route('signup') }}">现在注册！</a></p>
        </div>
      </div>
    </div>


@stop