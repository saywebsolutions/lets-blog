<?php

namespace SayWebSolutions\LetsBlog\Parser\Field;

use SayWebSolutions\LetsBlog\Markdown\Markdown;

class Body
{
    public static function process($key, $val, $data)
    {
        $data['body'] = Markdown::extra($val);

        return $data;
    }
}
