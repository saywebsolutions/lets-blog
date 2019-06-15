<?php

namespace SayWebSolutions\LetsBlog\Parser;

class Parser
{
    public static function parse($file)
    {
        preg_match('/^\-{3}(.*?)\-{3}(.*)/s', file_get_contents($file), $m);

        // the contents of the post
        $data = [
            'body' => $m[2]
        ];
        
        $last = '';

        // post info in first part of markdown file, one field per line
        $head = explode("\n", trim($m[1]));

        // each post property
        foreach ($head as $h) {
            //TODO - there is possibly a bug here - $key may get accessed before being set
            if (substr(trim($h), 0, 1) === '-' && ! empty($last)) {
                if (! is_array($data[$key])) {
                    $data[$key] = [];
                }
                $key = $last;
                $val = trim(trim(trim($h), '-'));
                array_push($data[$key], $val);
            } elseif (preg_match('/(.*?)\:(.*)/', $h, $m)) {
                $key = trim($m[1]);
                $val = trim($m[2]);
                $data[$key] = $val;
                $last = $key;
            }
        }

        return $data;
    }

    /**
     * undocumented function
     *
     * @param array $fields Fields that have been parsed (post object properties)
     *
     * @return void
     */
    public static function process($fields)
    {

        $path = __NAMESPACE__.'\Field\\';

        $data = [];

        foreach ($fields as $key => $val) {
            // name parsers in camel case with first char capitalized
            $class = $path . ucfirst(camel_case($key));

            // default to Meta class if no match
            if (! class_exists($class) or ! method_exists($class, 'process')) {
                $class = "{$path}Meta";
            }

            $data = $class::process($key, $val, $data);
        }

        return $data;
    }

    public static function handle($fields, $post)
    {

        foreach ($fields as $key => $val) {
            $class = __NAMESPACE__ . '\Field\\' . ucfirst(camel_case($key));

            if (class_exists($class) && method_exists($class, 'handle')) {
                $class::handle($key, $val, $post);
            }
        }
    }
}
