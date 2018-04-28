<?php

return [

    'app' => [

        'path' => 'blog',

        //route to admin path TODO - finish building out admin side
//        'admin_path' => 'admin',
        'admin_path' => 'false',

        //default theme
//        'theme' => 'letsblog::themes.default'

        //extend theme of parent site, currently setup for bootstrap 3 site
        'theme' => 'letsblog::themes.extension',
        'theme_extends' => 'layouts.app'

    ],

    'table' => [

        'prefix' => 'lb',

        //off for sqlite, turn on for mysql
        'use_fulltext_key' => 'false'

    ],

    'meta' => [
        'description' => 'LetsBlog is a blogging package for Laravel apps.',
        'keywords' => 'laravel, blog, package, letsblog, blogging, cms',
        'logo' => '/img/logo-200x200.png',
        'title' => 'LetsBlog'
    ],

    'routes' => [
        '/sitemap' => [
            'as' => 'sitemap',
            'uses' => '\SayWebSolutions\LetsBlog\Http\Controllers\BlogController@sitemap'
        ],
        
        '/blog' => [
            'as' => 'blog',
            'uses' => '\SayWebSolutions\LetsBlog\Http\Controllers\PostController@index'
        ],

        '/blog/feed' => [
            'as' => 'feed',
            'uses' => '\SayWebSolutions\LetsBlog\Http\Controllers\BlogController@feed'
        ],

        '/blog/feed/atom' => [
            'as' => 'atom',
            'uses' => '\SayWebSolutions\LetsBlog\Http\Controllers\BlogController@atom'
        ],

        '/blog/search' => [
            'as' => 'search',
            'uses' => '\SayWebSolutions\LetsBlog\Http\Controllers\PostController@search'
        ],

        '/blog/search.xml' => [
            'as' => 'opensearch',
            'uses' => '\SayWebSolutions\LetsBlog\Http\Controllers\BlogController@opensearch'
        ],

        '/blog/tags' => [
            'as' => 'tags',
            'uses' => '\SayWebSolutions\LetsBlog\Http\Controllers\TagController@index'
        ],

        '/blog/tags/{slug}' => [
            'uses' => '\SayWebSolutions\LetsBlog\Http\Controllers\TagController@show'
        ],

        '/blog/series' => [
            'as' => 'series',
            'uses' => '\SayWebSolutions\LetsBlog\Http\Controllers\SeriesController@index'
        ],

        '/blog/series/{slug}' => [
            'uses' => '\SayWebSolutions\LetsBlog\Http\Controllers\SeriesController@show'
        ],

//TODO - make the 'blog' path here respect the config setting
        '/blog/{any}' => [
            'uses' => '\SayWebSolutions\LetsBlog\Http\Controllers\PostController@post',
            'where' => ['any' => '(.*)']
        ]
    ],

    'nav' => [
        'title' => 'LetsBlog',
        'links' => [
            'Home' => '/blog',
            'Tags' => '/blog/tags',
            'Series' => '/blog/series'
        ]
    ],

    'posts' => [
        'perpage' => 15
    ],

    'site' => [
        'author' => 'Saywebsolutions',
        'name' => 'LetsBlog',
    ],

    'social' => [
        'twitter' => 'saywebsolutions',
        'facebook' => 'saywebsolutions',
    ],

    'footer' => [
        'copy' => true,
        'plug' => true,
    ]
];
