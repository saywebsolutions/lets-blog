<?php

namespace SayWebSolutions\LetsBlog\Parser\Field;

class Permalink
{
	public static function process($key, $val, $data)
	{
		$data['slug'] = $val;

		return $data;
	}
}
