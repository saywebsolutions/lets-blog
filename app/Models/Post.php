<?php

namespace SayWebSolutions\LetsBlog\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

//	protected $dates = ['published_at'];
	protected $dates = ['created_at', 'updated_at', 'published_at'];

	public $guarded = ['id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        $this->table = config('letsblog.table.prefix') . '_posts';
    }

    public function tags()
    {
        return $this->belongsToMany('SayWebSolutions\LetsBlog\Models\Tag', config('letsblog.table.prefix') . '_post_tag');
    }

    public function series()
    {
        return $this->belongsTo('SayWebSolutions\LetsBlog\Models\Series');
    }

    public function scopeSearch($q, $search)
    {
        return $q->whereRaw("MATCH (`title`, `body`) AGAINST (?)" , [$search]);
    }

    public function getUrlAttribute()
    {
        return '/'.config('letsblog.app.path').'/'.$this->slug;
    }

    public function getFullTitleAttribute()
    {
        return ($this->series ? $this->series->title . ' :: ' : '') . $this->title;
    }

/*
    public function getMetaAttribute($val)
    {
    	return json_decode($val);
    } /*   */

    public function getButtonsAttribute()
    {
        return $this->meta->buttons;
    }

    public function getImgAttribute()
    {
        return url('/') . (@$this->meta->img ?: config('letsblog.meta.logo'));
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<>', 'NULL')->where('type', 'post')->where('status', 'active')->orderBy('published_at', 'desc');
    }

    public static function getRecentPosts()
    {
        return Post::published()->with('tags')->orderBy('created_at','desc')->limit(18)->get();
    }

    public static function getAllTypes()
    {   
        return self::distinct()->pluck('type')->toArray();
    }

}
