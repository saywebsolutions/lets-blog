<?php

namespace SayWebSolutions\LetsBlog\Parser\Field;

class Keywords
{
    public static function process($key, $val, $data)
    {
        $data['keywords'] = $val;

        return $data;
    }
}
