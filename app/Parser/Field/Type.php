<?php

namespace SayWebSolutions\LetsBlog\Parser\Field;

class Type
{
    public static function process($key, $val, $data)
    {
        $data['type'] = $val;

        return $data;
    }
}
