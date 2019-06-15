<?php

namespace SayWebSolutions\LetsBlog\Parser\Field;

class Slug
{
    public static function process($key, $val, $data)
    {
        $data['slug'] = $val;

        return $data;
    }
}
