<?php

namespace SayWebSolutions\LetsBlog\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    public $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        
        $this->table = config('letsblog.table.prefix') . '_series';
    }

    public function posts()
    {
        return $this->hasMany('SayWebSolutions\LetsBlog\Models\Post');
    }

    public function getUrlAttribute()
    {
        return route('series').'/'.$this->slug;
    }
}
