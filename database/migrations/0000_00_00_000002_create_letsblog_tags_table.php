<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLetsBlogTagsTable extends Migration
{
    public function up()
    {
        $prefix = config('letsblog.table.prefix');

        Schema::create("{$prefix}_tags", function (Blueprint $t) {
            $t->increments('id')->unsigned();
            $t->string('slug', 255)->unique();
            $t->string('name', 255);
            $t->integer('posts_count')->unsigned()->default(0)->index();
            $t->timestamps();

            $t->index('created_at');
            $t->index('updated_at');
        });

        Schema::create("{$prefix}_post_tag", function (Blueprint $t) {
            $t->integer('post_id')->unsigned()->index();
            $t->integer('tag_id')->unsigned()->index();
        });
    }

    public function down()
    {
        $prefix = config('letsblog.table.prefix');

        Schema::drop("{$prefix}_post_tag");
        Schema::drop("{$prefix}_tags");
    }
}
