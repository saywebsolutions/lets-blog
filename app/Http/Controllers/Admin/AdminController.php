<?php

namespace SayWebSolutions\LetsBlog\Http\Controllers\Admin;

use SayWebSolutions\LetsBlog\Models\Post;
use SayWebSolutions\LetsBlog\Models\Tag;
use SayWebSolutions\LetsBlog\Models\Series;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Routing\Controller;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $totalPosts = Post::published()->count();
        $totalTags = Tag::count();
        $totalSeries = Series::count();

//      Tag::updateCounts();

        return view('letsblog::themes.master', [
        'view' => lb_view('admin.index'),
        'totalPosts' => $totalPosts,
        'totalTags' => $totalTags,
        'totalSeries' => $totalSeries,
        ]);
    }
}
