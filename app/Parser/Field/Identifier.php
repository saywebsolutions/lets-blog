<?php

namespace SayWebSolutions\LetsBlog\Parser\Field;

use SayWebSolutions\LetsBlog\Markdown\Markdown;

class Identifier
{
    public static function process($key, $val, $data)
    {
        $data['identifier'] = $val;

        return $data;
    }
}
