@extends('layouts.app')

@section('content')
<div class="container" style="padding-left: 0px;">
    <div class="col-md-12 " style="padding-left: 0px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>
                    <!-- <i class="glyphicon glyphicon-align-justify"></i> --> 
                {{ Auth::user()->belongsToClass()->first()->name}}
                    <a class="btn btn-success pull-right" onclick="$('#fileModal').modal()">
                        <i class="glyphicon glyphicon-plus"></i> 上传文件
                    </a>
                </h3>
            </div>

            <div class="panel-body">
                @if($fileuploads->count())
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>文件名</th>
                                <th class="text-right">操作</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($fileuploads as $keys=>$fileupload)
                                <tr>
                                    <td class="text-center"><strong>{{$keys+1}}</strong></td> 
                                    <td><a href="{{$fileupload->filepath}}">{{$fileupload->filename}}</a></td> 
                                    
                                    <td class="text-right">

                                        <form action="{{ route('fileuploads.destroy', $fileupload->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>{!! $fileuploads->links() !!}
                    <div class="pull-right" style="margin: 30px 20px;font-size: 16px">
                        共 {{ $fileuploads->total() }}
                         个文件
                    </div>
                </div>    
                @else
                    <h3 class="text-center alert alert-info">暂时没有资源上传!请联系老师</h3>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">上传新文件</h4>
      </div>
      <div class="modal-body">
        <form id="fileuploads" action="{{ route('fileuploads.store') }}" method="POST" enctype="multipart/form-data">
            <label for="file" class="control-label">选择文件:</label>
            <input type="file" name="file" class="form-control" id="file">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" onclick="event.preventDefault();
        document.getElementById('fileuploads').submit();" class="btn btn-primary">上传</button>
      </div>
    </div>
  </div>
</div>
@endsection