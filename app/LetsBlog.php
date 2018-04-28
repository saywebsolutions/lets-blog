<?php

namespace SayWebSolutions\LetsBlog;

use SayWebSolutions\LetsBlog\Models\Tag;
use SayWebSolutions\LetsBlog\Models\Post;
use SayWebSolutions\LetsBlog\Models\Series;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class LetsBlog
{
    public static function published()
    {
        return Post::with('tags', 'series')->paginate(config('letsblog.posts.perpage'));
    }

    public static function search($q = '')
    {
        if (empty($q)) {
            $q = Input::get('q');
        }

        return Post::where('published_at', '<>', 'NULL')->search($q)->where('type', 'post')->where('status', 'active')->orderBy('published_at', 'desc')->with('tags', 'series')->paginate(config('letsblog.posts.perpage'));
    }

    public static function related(Post $post, $limit = 6)
    {
        $q = Post::selectRaw("*, MATCH(title, body) AGAINST(?) AS score", [$post->title])->where('published_at', '<>', 'NULL')->search($post->title)->where('type', 'post')->where('status', 'active')->where('id', '<>', $post->id)->orderBy('score', 'desc')->with('tags', 'series')->limit($limit);

        if ((int)$post->series_id > 0) {
            $q->where('series_id', '<>', $post->series_id);
        }

        return $q->get();
    }

    public static function posts()
    {
        return Post::where('published_at', '<>', 'NULL')->where('type', 'post')->where('status', 'active')->orderBy('published_at', 'desc')->with('tags')->get();
    }

    public static function pages()
    {
        return Post::where('type', 'page')->where('status', 'active')->orderBy('title', 'asc')->get();
    }

    public static function last()
    {
        return Post::where('published_at', '<>', 'NULL')->where('type', 'post')->where('status', 'active')->orderBy('published_at', 'desc')->first();
    }

    public static function post($slug = '')
    {
        if (empty($slug)) {
            $slug = Request::path();
        }

        $slug = str_replace(config('letsblog.app.path').'/', '', $slug);

        $post = Post::where('slug', $slug)->with('tags', 'series')->first();

        //TODO - check for logged in admin and allow preview, add published_at logic
        if ($post && $post->type === 'post' && ($post->published_at === null || $post->status !== 'active') ) {
            return null;
        }

        return $post;
    }

    public static function top($amount = 10)
    {
        return Post::where('published_at', '<>', 'NULL')->where('type', 'post')->where('status', 'active')->orderBy('views_count', 'desc')->limit(10)->get();
    }

    public static function count()
    {
        return Post::where('published_at', '<>', 'NULL')->where('type', 'post')->where('status', 'active')->count();
    }

    public static function tags()
    {
        return Tag::orderBy('slug', 'asc')->get();
    }

    public static function publishedWhereTag($tag)
    {
        return $tag->posts()->where('published_at', '<>', 'NULL')->where('type', 'post')->where('status', 'active')->with('tags', 'series')->paginate(config('letsblog.posts.perpage'));
    }

    public static function series()
    {
        return Series::orderBy('slug', 'asc')->with('posts')->get();
    }

    public static function publishedWhereSeries($series)
    {
        return $series->posts()->where('published_at', '<>', 'NULL')->where('type', 'post')->where('status', 'active')->with('tags', 'series')->paginate(config('letsblog.posts.perpage'));
    }
}
