<?php

namespace SayWebSolutions\LetsBlog\Parser\Field;

use Illuminate\Support\Facades\DB;
use SayWebSolutions\LetsBlog\Models\Series as SeriesModel;

class Series
{
    public static function process($key, $val, $data)
    {
        $slug = str_slug($val);

        $series = SeriesModel::where('slug', $slug)->first();

        if (! $series) {
            $series = SeriesModel::create([
                'slug' => $slug,
                'title' => $val
            ]);

            echo 'New Series: ' . $val . "\n";
        }

        $data['series_id'] = $series->id;

        return $data;
    }

    public function cleanup()
    {
        $prefix = config('letsblog.table.prefix');

        DB::table($prefix . '_series')->update([
            'posts_count' => DB::Raw("(SELECT COUNT(*) FROM {$prefix}_posts WHERE {$prefix}_posts.series_id = {$prefix}_series.id)")
        ]);

        SeriesModel::where('posts_count', 0)->delete();
    }
}
