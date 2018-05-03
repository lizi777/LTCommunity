@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h3>
                    &nbsp;&nbsp;
                    <i class="glyphicon glyphicon-edit"></i>
                    &nbsp;&nbsp;
                    @if($activity->id)
                        {{Auth::user()->area->name}} - 活动编辑
                    @else
                        {{Auth::user()->area->name}} - 活动发布
                    @endif
                </h3>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($activity->id)
                    <form action="{{ route('activities.update', $activity->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('activities.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                <div class="form-group">
                    <input class="form-control" type="hidden" name="area" id="area-field" value="{{ Auth::user()->area_id }}" />
                </div> 
                <div class="form-group">
                	<label for="title-field">Title</label>
                	<input class="form-control" type="text" name="title" id="title-field" value="{{ old('title', $activity->title ) }}" />
                </div> 
                <div class="form-group">
                	<label for="content-field">活动内容</label>
                	<textarea name="content" id="editor" class="form-control" rows="3">{{ old('content', $activity->content ) }}</textarea>
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('activities.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@stop

@section('scripts')
    <script type="text/javascript"  src="{{ asset('js/module.min.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/hotkeys.min.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/uploader.min.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/simditor.min.js') }}"></script>

    <script>
    $(document).ready(function(){
        var editor = new Simditor({
            textarea: $('#editor'),
        
        upload: {
            url: '{{ route('activities.upload_image') }}',
            params: { _token: '{{ csrf_token() }}' },
            fileKey: 'upload_file',
            connectionCount: 3,
            leaveConfirm: '文件上传中，关闭此页面将取消上传。'
        },
        pasteImage: true,
        });
    });
    </script>

@stop