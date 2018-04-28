<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLetsBlogSeriesTable extends Migration
{
    public function up()
    {
        $prefix = config('letsblog.table.prefix');

        Schema::create("{$prefix}_series", function (Blueprint $t) {
            $t->increments('id');
            $t->string('slug')->unique();
            $t->string('title');
            $t->integer('posts_count')->unsigned()->default(0)->index();
            $t->timestamps();

            $t->index('created_at');
            $t->index('updated_at');
        });
    }

    public function down()
    {
        $prefix = config('letsblog.table.prefix');

        Schema::drop("{$prefix}_series");
    }
}
