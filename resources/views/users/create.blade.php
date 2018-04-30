@extends('layouts.app')
@section('title', '注册')

@section('content')
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading" style="background-color: #f0f0f0">
      <h5>注册</h5>
    </div>
    <div class="panel-body">
      @include('common.error')
      <form method="POST" action="{{ route('users.store') }}">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="name">名称：</label>
            <input type="text" name="name" class="form-control"  placeholder="输入您的名字(注册后可更改)" value="{{ old('name') }}">
          </div>

          <div class="form-group">
            <label for="email">邮箱：</label>
            <input type="text" name="email" placeholder="输入您的邮箱账户" class="form-control" value="{{ old('email') }}">
          </div>

          <div class="form-group">
            <label for="area_id">校区：</label>
              <select class="form-control" id="area" name="area_id" required>
                  <option value="" hidden disabled selected>请选择校区</option>
                  @foreach ($areas as $value)
                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                  @endforeach
              </select>
          </div>

          <div class="form-group">
            <label for="class_id">班级：</label>
              <select class="form-control" id="class" name="class_id" required>
              </select>
          </div>

          <div class="form-group">
            <label for="password">密码：</label>
            <input type="password" name="password" placeholder="输入您的密码(最少6位英文或数字)" class="form-control" value="{{ old('password') }}">
          </div>

          <div class="form-group">
            <label for="password_confirmation">确认密码：</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="请再次输入您的密码" value="{{ old('password_confirmation') }}">
          </div>

          <button type="submit" class="btn btn-primary">注册</button>
      </form>
    </div>
  </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
  $(function(){  
             
           $("#area").change(function(){  
                 
               var objectModel = {};  
               var   value = $(this).val();  
               var   type = $(this).attr('id');  
               objectModel[type] =value;  
               $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});  
               $.ajax({  
                   url:"/signup/classes", //你的路由地址  
                   type:"post",  
                   dataType:"json",  
                   data:objectModel,  
                   timeout:30000,  
                   success:function(data){  
  
                       $("#class").empty();  
                       var count = data.length;  
  
                       var i = 0;  
                       var b="";  
                          for(i=0;i<count;i++){  
                              b+="<option value='"+data[i].id+"'>"+data[i].name+"</option>";  
                          }  
                       $("#class").append(b);  
  
                   }  
               });  
           });  
  
             
             
})  
</script>>

@stop