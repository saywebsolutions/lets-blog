<?php

namespace SayWebSolutions\LetsBlog\Http\Controllers;

use SayWebSolutions\LetsBlog\LetsBlog;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller as BaseController;

class BlogController extends BaseController
{
    public function feed()
    {
        $content = view('letsblog::blog.feed', [
            'last' => LetsBlog::last(),
            'posts' => LetsBlog::posts()
        ]);

        return Response::make($content, '200')->header('Content-Type', 'text/xml');
    }

    public function atom()
    {
        $content = view('letsblog::blog.atom', [
            'last' => LetsBlog::last(),
            'posts' => LetsBlog::posts()
        ]);

        return Response::make($content, '200')->header('Content-Type', 'text/xml');
    }

    public function sitemap()
    {
        $content = view('letsblog::blog.sitemap', [
            'last' => LetsBlog::last(),
            'posts' => LetsBlog::posts(),
            'pages' => LetsBlog::pages(),
            'tags' => LetsBlog::tags(),
            'series' => LetsBlog::series()
        ]);

        return Response::make($content, '200')->header('Content-Type', 'text/xml');
    }

    public function opensearch()
    {
        $content = view('letsblog::blog.opensearch');

        return Response::make($content, '200')->header('Content-Type', 'text/xml');
    }
}
