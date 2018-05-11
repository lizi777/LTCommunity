@if (Session::has('message'))
<div class="container" style="margin-top: 20px">
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('message') }}
    </div>
</div>
@endif

@if (Session::has('success'))
<div class="container" style="margin-top: 20px">
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('success') }}
    </div>
</div>
@endif

@if (Session::has('danger'))
<div class="container" style="margin-top: 20px">
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('danger') }}
    </div>
</div>
@endif