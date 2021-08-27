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

class Google_Service_Compute_HealthStatus extends Google_Model
{
	public $healthState;
	public $instance;
	public $ipAddress;
	public $port;
	
	public function getHealthState()
	{
		return $this->healthState;
	}
	
	public function setHealthState($healthState)
	{
		$this->healthState = $healthState;
	}
	
	public function getInstance()
	{
		return $this->instance;
	}
	
	public function setInstance($instance)
	{
		$this->instance = $instance;
	}
	
	public function getIpAddress()
	{
		return $this->ipAddress;
	}
	
	public function setIpAddress($ipAddress)
	{
		$this->ipAddress = $ipAddress;
	}
	
	public function getPort()
	{
		return $this->port;
	}
	
	public function setPort($port)
	{
		$this->port = $port;
	}
}
