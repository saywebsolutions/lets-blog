<?php

namespace SayWebSolutions\LetsBlog\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        $this->table = config('letsblog.table.prefix').'_tags';
    }

    public function posts()
    {
        return $this->belongsToMany('SayWebSolutions\LetsBlog\Models\Post', config('letsblog.table.prefix').'_post_tag');
    }

    public function getUrlAttribute()
    {
        return route('tags').'/'.$this->slug;
    }

    public static function updateCounts()
    {
//        foreach(self::withCount('posts')->get() as $tag) {
        foreach (self::get() as $tag) {
            //TODO
            dd($tag);
            if ($tag->count != $tag->posts_count) {
                $tag->count = $tag->posts_count;
                $tag->save();
            }
        }
    }
}
