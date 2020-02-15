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

{{--
                <div class="col-xs-12">
                    @section ('layout.view')
                        @include ($view)
                    @show
                </div>
--}}

                <div class="col-md-8 col-lg-9">
                    @section ('layout.view')
                        @include ($view)
                    @show
                </div>

                <br class="hidden-md hidden-lg" style="clear:both;">

                <div class="col-md-4 col-lg-3">

                    @include (lb_view('components.search'))

                    <br>

                    @section ('layout.sidebar')

                        @include (lb_view('components.tags'), ['title' => 'Popular Tags', 'tags' => LetsBlog::popularTags(10)])

                    @show

                </div>

            @endif

        </div>

    </div>
@endsection
