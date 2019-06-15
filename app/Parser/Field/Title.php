<?php

namespace SayWebSolutions\LetsBlog\Parser\Field;

class Title
{
    public static function process($key, $val, $data)
    {
        $data['title'] = $val;

        return $data;
    }
}
