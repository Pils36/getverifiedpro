<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 10/03/2018
 * Time: 10:38 PM
 */

class Response
{
	public $status;
	public $data = array();
	public $message;
	
	function __construct($status = '', $data = null, $message = '')
	{
		$this->status = $status;
		$this->data = $data;
		$this->message = $message;
	}
}