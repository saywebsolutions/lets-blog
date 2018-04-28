<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLetsBlogBlogTable extends Migration
{
    public function up()
    {
        $prefix = config('letsblog.table.prefix');

        Schema::create("{$prefix}_posts", function (Blueprint $t) {
            $t->increments('id');
            $t->string('identifier', 255)->index();
            $t->integer('series_id')->unsigned()->nullable()->index();
            $t->integer('user_id')->unsigned()->nullable();
            $t->string('title');
            $t->string('slug')->unique();
            $t->string('keywords')->nullable();
            $t->string('meta')->nullable();
            $t->text('body');
            $t->enum('method', ['fs', 'wysiwyg'])->default('fs');
            $t->enum('type', ['page', 'post', 'redirect'])->default('post');
            $t->enum('status', ['active', 'deleted'])->default('active')->index();
            $t->integer('views_count')->unsigned()->default(0)->index();
            $t->datetime('published_at')->index()->nullable();
            $t->timestamps();

            $t->index('created_at');
            $t->index('updated_at');
        });

        if(config('letsblog.table.use_fulltext_key') === true){
            \DB::statement("ALTER TABLE {$prefix}_posts ADD FULLTEXT KEY {$prefix}_posts_title_body_fulltext (`title`, `body`)");
        }
    }

    public function down()
    {
        $prefix = config('letsblog.table.prefix');
        Schema::drop("{$prefix}_posts");
    }
}
