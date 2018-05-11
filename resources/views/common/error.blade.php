@if (count($errors) > 0)
<div class="row" style="margin-bottom: 0">
    <div class="col-md-12">
        <div class="alert alert-danger">
            <h5>有错误发生：</h5>
            <ul>
            @foreach ($errors->all() as $error)
                <li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>
            @endforeach
            </ul>
        </div>
    </div>
</div>
@endif