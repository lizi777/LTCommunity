<footer class="footer">
    <div class="container">
        <p class="pull-left">
             企业信息 <a href="http://www.actionsky.net" target="_blank">@蓝天<span style="color: #e27575;font-size: 14px;"><!-- ❤ --></span></a> 
        </p>

        <p class="pull-right">
        	@guest
        	@else
        	深圳蓝天教育 - {{Auth::user()->area()->first()->name}}，地址：{{Auth::user()->area()->first()->address}}
        	@endguest
        	<a href="mailto:name@email.com">联系我们</a></p>
    </div>
</footer>