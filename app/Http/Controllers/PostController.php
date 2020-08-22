<?php

namespace SayWebSolutions\LetsBlog\Http\Controllers;

use SayWebSolutions\LetsBlog\LetsBlog;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controller as BaseController;

class PostController extends BaseController
{
    public function index()
    {
        return view('letsblog::themes.master', [
            'view' => lb_view('post.index'),
            'posts' => LetsBlog::published(),
            'series' => LetsBlog::series(),
            'top' => LetsBlog::top()
        ]);
    }

    public function post()
    {

        $post = LetsBlog::post();

        if (! $post) {
            return self::notfound();
        }

//TODO - fix redirects, refactor into own customer parser, not in meta bag
/*
        if ($post->type === 'redirect') {
            return Redirect::to($post->meta->redirect_to, 301);
        } /*   */

        $post->increment('views_count');

        if ($post->type === 'page') {
            return self::page($post);
        }

        return view('letsblog::themes.master', [
            'view' => lb_view('post.show'),
            'post' => $post,
            'pageTitle' => $post->title,
            'pageDescription' => $post->meta,
            'pageKeywords' => $post->keywords,
            'series' => LetsBlog::series(),
            'top' => LetsBlog::top(),
//            'related' => LetsBlog::related($post)
        ]);
    }

    public function page($post)
    {
        return view('letsblog::themes.master', [
            'view' => lb_view('post.page'),
            'type' => 'page',
            'post' => $post,
            'pageTitle' => $post->title,
            'pageDescription' => $post->meta,
            'pageKeywords' => $post->keywords,
            'series' => LetsBlog::series(),
            'top' => LetsBlog::top()
        ]);
    }

    public function search()
    {
        return view('letsblog::themes.master', [
            'view' => lb_view('post.search'),
            'posts' => LetsBlog::search(),
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
