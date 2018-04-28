<?php

namespace SayWebSolutions\LetsBlog\Parser\Field;

use Log;
use Exception;
use Carbon\Carbon;

class PublishedAt
{
	public static function process($key, $val, $data)
	{
		try {
			$data['published_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $val.' 00:00:00');
		}
		catch (Exception $e) {
            Log::error($e->getMessage());
			$data['published_at'] = null;
		}

		return $data;
	}
}
