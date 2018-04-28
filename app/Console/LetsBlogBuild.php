<?php

namespace SayWebSolutions\LetsBlog\Console;

//use Carbon\Carbon;
use Illuminate\Console\Command;
use SayWebSolutions\LetsBlog\Parser\Type\Page;
use SayWebSolutions\LetsBlog\Parser\Type\Post;
use SayWebSolutions\LetsBlog\Parser\Field\Tags;
use SayWebSolutions\LetsBlog\Parser\Field\Series;

class LetsBlogBuild extends Command
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'letsblog:build';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Add and update blog posts.';

    /**
    * Execute the console command.
    *
    * @return mixed
    */
    public function handle()
    {
        $path = base_path(config('letsblog.app.path'));

        (new Post($path))->handle();
//        (new Page($path))->handle();

        // TODO: Where to register these cleanup functions?
        (new Tags)->cleanup();
        (new Series)->cleanup();
    }
}
