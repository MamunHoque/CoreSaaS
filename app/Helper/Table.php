<?php

namespace App\Helper;

use App\Helper\Traits\Tables;
use Illuminate\Support\Facades\DB;

class Table extends Helper
{
	use Tables;

	/**
	 * Existing TAble List
	 * 
	 * @return array
	 */
	public static function list()
	{
		return array_map('current', DB::select('SHOW TABLES'));
	}
}
