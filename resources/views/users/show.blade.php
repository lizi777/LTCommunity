@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
        <div class="panel panel-default">
            <div class="panel-body" @if($user->is_teacher)style="background-color:#fff5f5"@endif >
                <div class="media">
                    <div align="center">
                        <img class="thumbnail img-responsive" src="{{ $user->avatar }}" width="300px" height="300px">
                    </div>
                    <div class="media-body">
                        <hr>
                        <h4><strong>个人简介</strong></h4>
                        @if($user->introduciton != null)
                        <p>{{ $user->introduction }}</p>
                        @else
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;该用户很懒，没有留下任何东西。</p>
                        @endif
                        <hr>
                        <h4><strong>注册于&nbsp;&nbsp;<small>{{ $user->created_at->diffForHumans() }}</small></strong></h4>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <span>
                    <h1 class="panel-title pull-left" style="font-size:30px;">{{ $user->name }}@if($user->is_teacher) 老师@endif
                     <small>{{ $user->email }}</small></h1>
                </span>
            </div>
        </div>
        <hr>

{{-- 用户发布的内容 --}}
<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="{{ active_class(if_query('tab', null)) }}">
                <a href="{{ route('users.show', $user->id) }}">Ta 的话题</a>
            </li>
            <li class="{{ active_class(if_query('tab', 'replies')) }}">
                <a href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">Ta 的回复</a>
            </li>
        </ul>
        @if (if_query('tab', 'replies'))
            @include('users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(5)])
        @else
            @include('users._topics', ['topics' => $user->topics()->recent()->paginate(5)])
        @endif
    </div>
</div>

    </div>
</div>
</div>
@stop