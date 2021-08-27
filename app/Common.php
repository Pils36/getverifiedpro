<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 10/03/2018
 * Time: 10:38 PM
 */


use Firebase\JWT\JWT;

function clean_string($string)
{
	if (is_array($string)) {
		$data = [];
		foreach ($string as $key => $value) {
			$data[$key] = clean_string($value);
		}
	} else {
		return strip_tags(trim($string));
	}
}

function generate_string($length)
{
	$newID = "";
	$passwordRandomString = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789_";
	
	for ($x = 0; $x < $length; $x++) {
		$newID .= substr($passwordRandomString, rand(0, 62), 1);
	}
	return $newID;
}

function is_php($version)
{
	static $_is_php;
	$version = (string)$version;
	
	if (!isset($_is_php[$version])) {
		$_is_php[$version] = version_compare(PHP_VERSION, $version, '>=');
	}
	
	return $_is_php[$version];
}

function remove_invisible_characters($str, $url_encoded = TRUE)
{
	$non_displayables = array();
	
	// every control character except newline (dec 10),
	// carriage return (dec 13) and horizontal tab (dec 09)
	if ($url_encoded) {
		$non_displayables[] = '/%0[0-8bcef]/i';    // url encoded 00-08, 11, 12, 14, 15
		$non_displayables[] = '/%1[0-9a-f]/i';    // url encoded 16-31
		$non_displayables[] = '/%7f/i';    // url encoded 127
	}
	
	$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';    // 00-08, 11, 12, 14-31, 127
	
	do {
		$str = preg_replace($non_displayables, '', $str, -1, $count);
	} while ($count);
	
	return $str;
}


function set_status_header($code = 200, $text = '')
{
	
	if (empty($code) OR !is_numeric($code)) {
		show_error('Status codes must be numeric', 500);
	}
	
	if (empty($text)) {
		is_int($code) OR $code = (int)$code;
		$stati = array(
			100 => 'Continue',
			101 => 'Switching Protocols',
			
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			307 => 'Temporary Redirect',
			
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			422 => 'Unprocessable Entity',
			426 => 'Upgrade Required',
			428 => 'Precondition Required',
			429 => 'Too Many Requests',
			431 => 'Request Header Fields Too Large',
			
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported',
			511 => 'Network Authentication Required',
		);
		
		if (isset($stati[$code])) {
			$text = $stati[$code];
		} else {
			show_error('No status text available. Please check your status code number or supply your own message text.', 500);
		}
	}
	
	if (strpos(PHP_SAPI, 'cgi') === 0) {
		header('Status: ' . $code . ' ' . $text, TRUE);
		return;
	}
	
	$server_protocol = (isset($_SERVER['SERVER_PROTOCOL']) && in_array($_SERVER['SERVER_PROTOCOL'], array('HTTP/1.0', 'HTTP/1.1', 'HTTP/2'), TRUE))
		? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
	header($server_protocol . ' ' . $code . ' ' . $text, TRUE, $code);
}

function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered')
{
	$status_code = abs($status_code);
	if ($status_code < 100) {
		$exit_status = $status_code + 9; // 9 is EXIT__AUTO_MIN
		$status_code = 500;
	} else {
		$exit_status = 1; // EXIT_ERROR
	}
	
	echo $heading . '<br>' . $message . $status_code;
	exit($exit_status);
}

/**
 * @param $method | POST OR GET
 * @param $url | api link
 * @param bool $data | array of what to send
 * @return mixed
 */

$response = callAPI('GET', 'htttp://dsfd.jsp', [
	'suit_no' => 'value',
	'pin' => 'value',
	]);

function callAPI($method, $url, $data = false)
{
	$curl = curl_init();
	
	switch ($method) {
		case "POST":
			
			$options = [
				CURLOPT_URL => $url,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $data,
			];
			
			
			curl_setopt($curl, CURLOPT_POST, 1);
			
			if ($data)
//				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				curl_setopt_array($curl, $options);
			break;
		case "PUT":
			curl_setopt($curl, CURLOPT_PUT, 1);
			break;
		default:
			if ($data)
				$url = sprintf("%s?%s", $url, http_build_query($data));
	}
	
	// Optional Authentication:
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_USERPWD, "username:password");
	
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	
	$result = curl_exec($curl);
	
	curl_close($curl);
	
	return $result;
}


function validateLogin()
{
	if (!empty($_SESSION['token'])) {
		$jwt = $_SESSION['token'];
	} else {
		return false;
	}
	try {
		JWT::$leeway = 10;
		$decoded = JWT::decode($jwt, base64_decode(SECRET_KEY), [ALGORITHM]);
		$decoded_array = (array)$decoded;
		
		$_SESSION['login_id'] = $decoded_array['data']->id;
		return $decoded_array;
	} catch (Exception $e) {
		unset($_SESSION['token']);
		return false;
	}
}


function save_online_picture($picture_url, $name, $path = '')
{
	if (empty($path)) $path = ROOT . 'public_html/assets/resources/pics/';
	try {
		$ch = curl_init($picture_url);
		$fp = fopen($path . $name, 'wb');
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
		return true;
	} catch (Exception $e) {
		return false;
	}
	
}


function make_array_unique($array, $primary = '')
{
	$log = array();
	if (!empty($array)) {
		foreach ($array as $key => $innerarray) {
			if (!is_array($innerarray)) {
				return array_unique($array);
			} else {
				$unique = $innerarray[$primary];
				if (in_array($unique, $log)) {
					unset($array[$key]);
				}
				$log[] = $unique;
			}
		}
	}
	
	return $array;
}


function get_file_extension($path)
{
	$array = explode(".", $path);
	$ext = strtolower(end($array));
	return $ext;
}
