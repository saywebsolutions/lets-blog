<?php

namespace SayWebSolutions\LetsBlog;

use Illuminate\Support\Facades\Facade;

class LetsBlogFacade extends Facade
{
    protected static function getFacadeAccessor()
    { 
        return 'letsblog';
    }
}
