<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 10/03/2018
 * Time: 10:38 PM
 */

class Router
{
	
	public $uri_string = '';
	public $segments = array();
	
	
	public function __construct()
	{
		
		$uri = $this->_parse_request_uri();
		
		$this->_set_uri_string($uri);
	}
	
	protected function _parse_request_uri()
	{
		if (!isset($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME'])) {
			return '';
		}
		
		// parse_url() returns false if no host is present, but the path or query string
		// contains a colon followed by a number
		$uri = parse_url('http://dummy' . $_SERVER['REQUEST_URI']);
		$query = isset($uri['query']) ? $uri['query'] : '';
		$uri = isset($uri['path']) ? $uri['path'] : '';
		
		if (isset($_SERVER['SCRIPT_NAME'][0])) {
			if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
				$uri = (string)substr($uri, strlen($_SERVER['SCRIPT_NAME']));
			} elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0) {
				$uri = (string)substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
			}
		}
		
		// This section ensures that even on servers that require the URI to be in the query string (Nginx) a correct
		// URI is found, and also fixes the QUERY_STRING server var and $_GET array.
		if (trim($uri, '/') === '' && strncmp($query, '/', 1) === 0) {
			$query = explode('?', $query, 2);
			$uri = $query[0];
			$_SERVER['QUERY_STRING'] = isset($query[1]) ? $query[1] : '';
		} else {
			$_SERVER['QUERY_STRING'] = $query;
		}
		
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		
		if ($uri === '/' OR $uri === '') {
			return '/';
		}
		
		// Do some final cleaning of the URI and return it
		return $this->_remove_relative_directory($uri);
	}
	
	protected function _remove_relative_directory($uri)
	{
		$uris = array();
		$tok = strtok($uri, '/');
		while ($tok !== FALSE) {
			if ((!empty($tok) OR $tok === '0') && $tok !== '..') {
				$uris[] = $tok;
			}
			$tok = strtok('/');
		}
		
		return implode('/', $uris);
	}
	
	protected function _set_uri_string($str)
	{
		// Filter out control characters and trim slashes
		$this->uri_string = trim(remove_invisible_characters($str, FALSE), '/');
		
		if ($this->uri_string !== '') {
			
			$this->segments[0] = NULL;
			// Populate the segments array
			foreach (explode('/', trim($this->uri_string, '/')) as $val) {
				$val = trim($val);
				// Filter segments for security
				
				if ($val !== '') {
					$this->segments[] = $val;
				}
			}
			
			unset($this->segments[0]);
		}
	}
	
	public function get_route()
	{

		// print_r($this->uri_string);

		return $this->uri_string;
	}
	
	
}