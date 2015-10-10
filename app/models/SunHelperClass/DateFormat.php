<?php 
namespace SunHelperClass;

class DateFormat
{
	public static function store($date)
	{
		return date_format(date_create($date), 'Y-m-d');
	}

	public static function show($date)
	{
		return date_format(date_create($date), 'd-m-Y');
	}

	public static function diff($from , $to)
	{
		$datetime1 = date_create($from);
		$datetime2 = date_create($to);
		$interval = date_diff($datetime1, $datetime2);
		return $interval->format('%R%a days');
	}
}