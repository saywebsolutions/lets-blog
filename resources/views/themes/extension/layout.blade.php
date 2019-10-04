@extends (config('letsblog.app.theme_extends'))

@section ('content')
    <div class="container-fluid">

        <br class="hidden-sm hidden-md hidden-lg">

        <div class="row">

            @if (Request::segment(1) == config('letsblog.app.admin_path'))

                <nav class="col-md-3 col-lg-2 no-right-pad" role="navigation">
                    @section ('layout.sidebar')
                        @include (lb_view('admin.parts.admin_menu'))
                    @show
                </nav>

                <div class="col-md-9 col-lg-10">
                    @section ('layout.view')
                        @include ($view)
                    @show
                </div>

            @else

                <div class="col-xs-12">
                    @section ('layout.view')
                        @include ($view)
                    @show
                </div>

            @endif

        </div>

    </div>
@endsection
