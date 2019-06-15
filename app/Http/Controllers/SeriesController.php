<?php

namespace SayWebSolutions\LetsBlog\Http\Controllers;

use SayWebSolutions\LetsBlog\LetsBlog;
use SayWebSolutions\LetsBlog\Models\Series;
use Illuminate\Routing\Controller as BaseController;

class SeriesController extends BaseController
{
    public function index()
    {
        return view('letsblog::themes.master', [
            'view' => lb_view('series.index'),
            'series' => LetsBlog::series(),
            'top' => LetsBlog::top()
        ]);
    }

    public function show($slug)
    {
        $part = Series::where('slug', $slug)->first();

        if (! $part) {
            return self::notfound();
        }
        return view('letsblog::themes.master', [
            'view' => lb_view('series.show'),
            'part' => $part,
            'posts' => LetsBlog::publishedWhereSeries($part),
            'series' => LetsBlog::series(),
            'top' => LetsBlog::top()
        ]);
    }

    public function notfound()
    {
        return view('letsblog::themes.master', [
            'view' => lb_view('error.404'),
            'series' => LetsBlog::series(),
            'top' => LetsBlog::top()
        ]);
    }
}
