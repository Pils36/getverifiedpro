<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

class Google_Service_Bigquery_QueryParameterTypeStructTypes extends Google_Model
{
	public $description;
	public $name;
	protected $typeType = 'Google_Service_Bigquery_QueryParameterType';
	protected $typeDataType = '';
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	/**
	 * @param Google_Service_Bigquery_QueryParameterType
	 */
	public function setType(Google_Service_Bigquery_QueryParameterType $type)
	{
		$this->type = $type;
	}
	
	/**
	 * @return Google_Service_Bigquery_QueryParameterType
	 */
	public function getType()
	{
		return $this->type;
	}
}
