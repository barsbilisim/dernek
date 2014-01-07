<?php

class BaseController extends Controller
{

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/*
	* Method to strip tags globally.
	*/
	public static function globalXssClean()
	{
		// Recursive cleaning for array [] inputs, not just strings.
		$sanitized = static::arrayStripTags(Input::all());
		Input::merge($sanitized);
	}

	public static function arrayStripTags($array)
	{
		$result = array();

		foreach ($array as $key => $value)
		{
			// Don't allow tags on key either, maybe useful for dynamic forms.
			$key = strip_tags($key);

			// If the value is an array, we will just recurse back into the
			// function to keep stripping the tags out of the array,
			// otherwise we will set the stripped value.
			if (is_array($value))
				$result[$key] = static::arrayStripTags($value);
			else
			// I am using strip_tags(), you may use htmlentities(),
			// also I am doing trim() here, you may remove it, if you wish.
			$result[$key] = trim(strip_tags($value));
		}

	return $result;
	}

	public static function generatePassword($length = 8)
	{
		$chars  = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
		$count  = mb_strlen($chars);

		for($i = 0, $result = ""; $i < $length; $i++)
			$result .= $chars[rand(0, $count - 1)];

		return $result;
	}

	public static function dateDiff($date)
	{
		$d1 = date_create(date("Y-m-d"));
		$d2 = new DateTime($date);
		$d2   = date_create($d2->format("Y-m-d"));
		$days = date_diff($d1, $d2);
		
		return $days->format('%R%a');
	}

	public static function send_sms($Url, $strRequest)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $Url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1) ;
		curl_setopt($ch, CURLOPT_POSTFIELDS, $strRequest);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
}