@section ('admin.dashboard')

<div class="jumbotron">
  <h1>Let's Blog!</h1>
</div>
        
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-pencil fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <h3 style="color:white; margin-top:0px;">{{ number_format($totalPosts) }} Posts</h3>
                    </div>
                </div>
            </div>
            <a href="/admin/posts">
                <div class="panel-body">
                    <span class="pull-left">View Posts</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tags fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <h3 style="color:white; margin-top:0px;">{{ number_format($totalTags) }} Tags</h3>
                    </div>
                </div>
            </div>
            <a href="/admin/tags">
                <div class="panel-body">
                    <span class="pull-left">View Tags</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-book fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <h3 style="color:white; margin-top:0px;">{{ $totalSeries }} Series</h3>
                    </div>
                </div>
            </div>
            <a href="/admin/series">
                <div class="panel-body">
                    <span class="pull-left">View Series</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

</div>
<!-- /.row -->  

@show
          
@section ('javascript')

@stop
