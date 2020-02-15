<?php

namespace SayWebSolutions\LetsBlog\Http\Controllers;

use SayWebSolutions\LetsBlog\LetsBlog;
use SayWebSolutions\LetsBlog\Models\Tag;
use Illuminate\Routing\Controller as BaseController;

class TagController extends BaseController
{
    public function index()
    {

        $formats = [

            [
                'id' => 'tags-by-count-descending',
                'sortFunction' => 'sortByDesc',
                'sortField' => 'posts_count',
                'label' => 'Count (desc.)',
            ],

            [
                'id' => 'tags-by-count-asscending',
                'sortFunction' => 'sortBy',
                'sortField' => 'posts_count',
                'label' => 'Count (asc.)',
            ],

            [
                'id' => 'tags-alphabetical-order-ascending',
                'sortFunction' => 'sortBy',
                'sortField' => 'name',
                'label' => 'Alphabetical (asc.)',
            ],

            [
                'id' => 'tags-alphabetical-order-descending',
                'sortFunction' => 'sortByDesc',
                'sortField' => 'name',
                'label' => 'Alphabetical (desc.)',
            ],

        ];

        return view('letsblog::themes.master', [
            'view' => lb_view('tag.index'),
            'tags' => LetsBlog::tags(),
            'series' => LetsBlog::series(),
            'top' => LetsBlog::top(),
            'formats' => $formats,
        ]);
    }

    public function show($slug)
    {

        $tag = Tag::where('slug', $slug)->first();

        if (! $tag) {
            return self::notfound();
        }
        
        return view('letsblog::themes.master', [
            'view' => lb_view('tag.show'),
            'tag' => $tag,
            'posts' => LetsBlog::publishedWhereTag($tag),
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
