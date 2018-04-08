@extends('layouts.app')

@section('content')



<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
<div class="container">
    <div class="panel panel-default col-md-10 col-md-offset-1">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-edit"></i> 编辑个人资料
            </h4>
        </div>
        @include('common.error')
        <div class="panel-body">

            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="name-field">用户名</label>
                    <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $user->name ) }}" />
                </div>
                <div class="form-group">
                    <label for="email-field">邮 箱</label>
                    <input class="form-control" type="text" name="email" id="email-field" value="{{ old('email', $user->email ) }}" />
                </div>
                <div class="form-group">
                    <label for="introduction-field">个人简介</label>
                    <textarea name="introduction" id="introduction-field" class="form-control" rows="3">{{ old('introduction', $user->introduction ) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="" class="avatar-label">用户头像</label> 
                    <input type="file" name="avatar">
                </div>
                @if($user->avatar)
                <br>
                <img class="thumbnail img-responsive" src="{{ $user->avatar }}" width="200" />
                @endif

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- <script src="{{ asset('imgCrop/head/jQuery.min.js') }}"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('imgCrop/css/bootstrap.min.css') }}">
<link href="{{ asset('imgCrop/head/cropper.min.css') }}" rel="stylesheet">
<link href="{{ asset('imgCrop/head/sitelogo.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('imgCrop/css/font-awesome.min.css') }}">

<script src="{{ asset('imgCrop/head/bootstrap.min.js') }}"></script>
<script src="{{ asset('imgCrop/head/cropper.js') }}"></script>
<script src="{{ asset('imgCrop/head/sitelogo.js') }}"></script>
<script src="{{ asset('imgCrop/head/html2canvas.min.js') }}" type="text/javascript" charset="utf-8"></script> -->


@endsection