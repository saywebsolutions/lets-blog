<?php

namespace SayWebSolutions\LetsBlog\Parser\Field;

use SayWebSolutions\LetsBlog\LetsBlog;
use Illuminate\Support\Facades\DB;
use SayWebSolutions\LetsBlog\Models\Tag;

class Tags
{
    public static function process($key, $val, $data)
    {
        return $data;
    }

    public static function handle($key, $val, $post)
    {

/*
        $tag_list = explode(',', $val);
        dd($tag_list);

        $tags = [];

        foreach ($tag_list as $v) {
            $v = trim($v);

            if (empty($v)) {
                continue;
            }

            $slug = str_slug($v);

            $tag = Tag::where('slug', $slug)->first();

            if ( ! $tag) {
                $tag = Tag::create([
                    'slug' => $slug,
                    'name' => $v
                ]);
            }

            array_push($tags, $tag);
        }

/*   */

        $tag_list = explode(',', $val);

        //check if tag array is empty, if it is we will sync a blank array (to remove all tags for this post from the pivot table
        $tag_ids = [];

        foreach ($tag_list as $tag_name) {
            $tag_name = trim($tag_name);
            $tag = Tag::where('slug', str_slug($tag_name))->first();

            if (! $tag) {
                $tag = Tag::create(['name' => $tag_name, 'slug' => str_slug($tag_name)]);
            }

            //store tag id in array for sync operation after foreach
            $tag_ids[] = $tag->id;
        }

        $tags_old = $post->tags->pluck('id')->toArray();

        $diff = array_merge(array_diff($tags_old, $tag_ids), array_diff($tag_ids, $tags_old));

        if (count($diff) > 0) {
            $post->tags()->sync($tag_ids);
            echo 'Updated Tags: ' . $val . "\n";
        }
    }

    public function cleanup()
    {

/*
        $prefix = config('letsblog.table.prefix');

        // Clean out any old pivot data.
//        DB::statement("DELETE {$prefix}_post_tag
        DB::statement("DELETE
            FROM {$prefix}_post_tag
                LEFT JOIN {$prefix}_posts
                    ON {$prefix}_post_tag.post_id = {$prefix}_posts.id
            WHERE NOT({$prefix}_post_tag.post_id = {$prefix}_posts.id
                AND {$prefix}_posts.status = 'active'
                AND {$prefix}_posts.type='post')"
        );

        // TODO: convert to eloquent?
        DB::table($prefix . '_tags')->update([
            'posts_count' => DB::Raw("(SELECT COUNT(*) FROM {$prefix}_post_tag WHERE {$prefix}_post_tag.tag_id = {$prefix}_tags.id)")
        ]);

        Tag::where('posts_count', 0)->delete();
/*   */
    }
}
