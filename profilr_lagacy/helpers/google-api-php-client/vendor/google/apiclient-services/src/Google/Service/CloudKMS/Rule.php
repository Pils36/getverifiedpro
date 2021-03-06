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

class Google_Service_CloudKMS_Rule extends Google_Collection
{
	public $action;
	public $description;
	public $in;
	public $notIn;
	public $permissions;
	protected $collection_key = 'permissions';
	protected $conditionsType = 'Google_Service_CloudKMS_Condition';
	protected $conditionsDataType = 'array';
	protected $logConfigType = 'Google_Service_CloudKMS_LogConfig';
	protected $logConfigDataType = 'array';
	
	public function getAction()
	{
		return $this->action;
	}
	
	public function setAction($action)
	{
		$this->action = $action;
	}
	
	/**
	 * @param Google_Service_CloudKMS_Condition
	 */
	public function setConditions($conditions)
	{
		$this->conditions = $conditions;
	}
	
	/**
	 * @return Google_Service_CloudKMS_Condition
	 */
	public function getConditions()
	{
		return $this->conditions;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getIn()
	{
		return $this->in;
	}
	
	public function setIn($in)
	{
		$this->in = $in;
	}
	
	/**
	 * @param Google_Service_CloudKMS_LogConfig
	 */
	public function setLogConfig($logConfig)
	{
		$this->logConfig = $logConfig;
	}
	
	/**
	 * @return Google_Service_CloudKMS_LogConfig
	 */
	public function getLogConfig()
	{
		return $this->logConfig;
	}
	
	public function getNotIn()
	{
		return $this->notIn;
	}
	
	public function setNotIn($notIn)
	{
		$this->notIn = $notIn;
	}
	
	public function getPermissions()
	{
		return $this->permissions;
	}
	
	public function setPermissions($permissions)
	{
		$this->permissions = $permissions;
	}
}
