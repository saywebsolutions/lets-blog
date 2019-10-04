<?php

namespace SayWebSolutions\LetsBlog\Parser;

use Exception;

class Parser
{
    public static function parse($file)
    {
        preg_match('/^\-{3}(.*?)\-{3}(.*)/s', file_get_contents($file), $m);

        // the contents of the post
        $data = ['body' => $m[2]];
        
        $last = '';

        // post info in first part of markdown file, one field per line
        $head = explode("\n", trim($m[1]));

        // each post property
        foreach ($head as $h) {

            $h = trim($h);

            //parse redirects
            if (substr($h, 0, 1) === '-' && ! empty($last)) {

                if (isset($key) && ! is_array($data[$key])) {
                    $data[$key] = [];
                }
                $key = $last;
                $val = trim(trim($h, '-'));
                array_push($data[$key], $val);

            //parse regular fields (ex. title, slug, keywords, etc.)
            } elseif (preg_match('/(.*?)\:(.*)/', $h, $m)) {

                $key = $last = trim($m[1]);
                $val = trim($m[2]);
                $data[$key] = $val;

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
            $class = $path.ucfirst(camel_case($key));

            // throw exception if no class for current field type
            if ( ! class_exists($class) or ! method_exists($class, 'process')) {
                throw new Exception('Class for field type: "'. $class.'" does not exist');
            }else{
                $data = $class::process($key, $val, $data);
            }
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
