@extends('layouts.app')

@section('title', '话题列表')

@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-9 col-md-9 topic-list">
        @if (isset($klasse))
        <div class="row" style="margin-bottom: 3px ">
            @if(Auth::user()->is_teacher)
            <div class="col-lg-10 col-md-10">
            <div class="alert alert-info" role="alert">
                {{ $klasse->name }} ：{{ $klasse->notice }} 
            </div>
            </div>
            <div class="col-lg-2 col-md-2" style="padding: 4px 20px 0 2px;">
                <div class="btn btn-success btn-block btn-lg" onclick="$('#klassesmodal').modal()">修改</div>
            </div>
            @else
            <div class="alert alert-info" style="margin-left: 15px;margin-right: 15px" role="alert">
                {{ $klasse->name }} ：{{ $klasse->notice }} 
            </div>
            @endif
        </div>
        @endif
        <div class="panel panel-default">

            <div class="panel-heading">
                <ul class="nav nav-pills">
                    <li class="{{ active_class( ! if_query('order', 'recent') ) }}"><a href="{{ Request::url() }}?order=default">最后回复</a></li>
                    <li class="{{ active_class(if_query('order', 'recent')) }}"><a href="{{ Request::url() }}?order=recent">最新发布</a></li>
                </ul>
            </div>

            <div class="panel-body">
                {{-- 话题列表 --}}
                @include('topics._topic_list', ['topics' => $topics])
                {{-- 分页 --}}
                {!! $topics->render() !!}
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 sidebar">
        @include('topics._sidebar')
    </div>
</div>
</div>
@if (isset($klasse))
<div class="modal fade" tabindex="-1" role="dialog" id="klassesmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">输入内容</h4>
      </div>
      <div class="modal-body">
        <form id="klasses_update" action="{{ route('klasses.update',$klasse->id) }}" method="POST" >
            <label for="notice" class="control-label">输入内容：</label>
            <input type="notice" name="notice" class="form-control" id="notice">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="button" class="btn btn-primary" onclick="
        document.getElementById('klasses_update').submit();">提交</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endif
@endsection