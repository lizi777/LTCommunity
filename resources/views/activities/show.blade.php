
@extends('layouts.app')

@section('title', $activity->title)
@section('description', $activity->excerpt)

@section('content')
<div class="container">
<div class="row">


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topic-content">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 class="text-center">
                    {{ $activity->title }}
                </h1>

                <div class="article-meta text-center">

                    
                    {{ Auth::user()->area()->first()->name }}
                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                     ⋅ 
                    {{ $activity->created_at->diffForHumans() }}发布
                    
                </div>
<hr>
                <div class="topic-body">
                    {!! $activity->content !!}
                </div>

                @can('update', $activity)
                    <div class="operate">
                        <hr>
                        <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-default btn-xs pull-left" role="button">
                            <i class="glyphicon glyphicon-edit"></i> 编辑
                        </a>

                        <form action="{{ route('activities.destroy', $activity->id) }}" method="post" onsubmit="return confirm('删除后无法恢复！确定要删除吗？');">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-default btn-xs pull-left" style="margin-left: 6px">
                                <i class="glyphicon glyphicon-trash"></i>
                                删除
                            </button>
                        </form>
                    </div>
                @endcan

            </div>
        </div>

    </div>
</div>
</div>
@stop