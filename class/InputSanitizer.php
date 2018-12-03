<?php

class InputSanitizer {

	public static function cleanInput($input) {

		$search = array(
			'@<script[^>]*?>.*?</script>@si',
			'@<[\/\!]*?[^<>]*?>@si',
			'@<style[^>]*?>.*?</style>@siU',
			'@<![\s\S]*?--[ \t\n\r]*>@'
		);

		$output = preg_replace($search, '', $input);
		return $output;
	}

	public static function sanitize($mysqli,$input) {
		if (is_array($input)) {
			foreach($input as $var=>$val) {
				$output[$var] = self::sanitize($mysqli,$val);
			}
		}
		else {
			if (get_magic_quotes_gpc()) {
				$input = stripslashes($input);
			}
			$input  = self::cleanInput($input);
			$output = $mysqli->escape_string($input);
		}
		return $output;
	}

}