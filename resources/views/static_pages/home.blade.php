@extends('layouts.app')
@section('title', '主页')

@section('content')
<div class="jumbotron">
  <div class="container">
    <h2>
    	欢迎来到蓝天教育社区<small>&nbsp;&nbsp;在登录后你可以：</small>
    	<br>
    	<small><ul>
    		<li>查看他人主页与动态</li>
    		<li>与同学与老师交流学习</li>
    		<li>获取更多学习信息：如下载班级资源与查看校区活动</li>
    	</ul></small>


      <a href="{{route('login')}}" class="btn btn-success btn-lg pull-right" role="button">前往@guest登陆 @else讨论 @endguest</a>
    </h2>
  </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-9" role="main">
			@foreach($topics as $topic)
			<div class="media">
			<div class="media-left">
			<a href="">
				<img class="media-object img-circle" alt="64x64" src="{{$topic->user()->first()->avatar}}" style="width:64px;height:64px">
			</a>
			</div>
			<div class="media-body">
				<h4 class="media-heading" style="padding-top: 10px">   <a href="{{ $topic->link() }}" >

                            {{ $topic->title }}

            <span class="badge"> {{ $topic->reply_count }} </span>
                    </a>
				</h4>
				                作者：<a href="{{ route('users.show', [$topic->user_id]) }}" title="{{ $topic->user->name }}">
                    {{ $topic->user->name }}
                </a>
			</div>


			</div>
			@endforeach
		</div>
	</div>
</div>
@stop