<?php

namespace SayWebSolutions\LetsBlog\Parser\Field;

class Meta
{
    public static function process($key, $val, $data)
    {
/*
        if ( ! isset($data['meta'])) {
            $data['meta'] = [];
        }
        else {
            $data['meta'] = (array)json_decode($data['meta']);
        }

        $data['meta'][$key] = $val;

        $data['meta'] = json_encode($data['meta']);
        /*   */

        $data['meta'] = $val;

        return $data;
    }
}
