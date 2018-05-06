@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>
                    <i class="glyphicon glyphicon-align-justify"></i> 活动列表
                    <a class="btn btn-success pull-right" href="{{ route('activities.create') }}"><i class="glyphicon glyphicon-plus"></i> 创建活动</a>
                </h4>
            </div>

            <div class="panel-body">
                @if($activities->count())
                    <table class="table table-condensed table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="1"></th>
                                <th >校区名称</th> <th>活动标题</th> <th>摘要</th>
                                <th class="text-right">选项</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($activities as $keys=>$activity)
                                <tr style="cursor: pointer;" onclick="location.href='{{ route('activities.show', $activity->id) }}';"
                                @if($loop->last ){
                                    style="border-bottom: 1px solid #ddd"
                                }@endif
                                >
                                    <td width="5%" class="text-center"><strong>{{$keys+1}}</strong></td>

                                    <td width="12%">{{$activity->belongsToArea()->first()->name}}</td> <td width="25%">{{$activity->title}}</td> <td>{{$activity->excerpt}}</td>
                                    
                                    <td width="13%" class="text-right">
<!--                                         <a class="btn btn-xs btn-primary" href="{{ route('activities.show', $activity->id) }}">
                                            <i class="glyphicon glyphicon-eye-open"></i> 
                                        </a> -->
                                        
                                        <a class="btn btn-xs btn-warning" href="{{ route('activities.edit', $activity->id) }}">
                                            <i class="glyphicon glyphicon-edit"></i> 
                                        </a>

                                        <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('删除后无法恢复！确定要删除吗？');">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                                </a>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $activities->render() !!}
                @else
                    <h4 class="text-center alert alert-info">暂无活动!</h4>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection