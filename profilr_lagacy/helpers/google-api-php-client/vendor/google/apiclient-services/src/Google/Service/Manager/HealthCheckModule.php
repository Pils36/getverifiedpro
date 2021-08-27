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

class Google_Service_Manager_HealthCheckModule extends Google_Model
{
	public $checkIntervalSec;
	public $description;
	public $healthyThreshold;
	public $host;
	public $path;
	public $port;
	public $timeoutSec;
	public $unhealthyThreshold;
	
	public function getCheckIntervalSec()
	{
		return $this->checkIntervalSec;
	}
	
	public function setCheckIntervalSec($checkIntervalSec)
	{
		$this->checkIntervalSec = $checkIntervalSec;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getHealthyThreshold()
	{
		return $this->healthyThreshold;
	}
	
	public function setHealthyThreshold($healthyThreshold)
	{
		$this->healthyThreshold = $healthyThreshold;
	}
	
	public function getHost()
	{
		return $this->host;
	}
	
	public function setHost($host)
	{
		$this->host = $host;
	}
	
	public function getPath()
	{
		return $this->path;
	}
	
	public function setPath($path)
	{
		$this->path = $path;
	}
	
	public function getPort()
	{
		return $this->port;
	}
	
	public function setPort($port)
	{
		$this->port = $port;
	}
	
	public function getTimeoutSec()
	{
		return $this->timeoutSec;
	}
	
	public function setTimeoutSec($timeoutSec)
	{
		$this->timeoutSec = $timeoutSec;
	}
	
	public function getUnhealthyThreshold()
	{
		return $this->unhealthyThreshold;
	}
	
	public function setUnhealthyThreshold($unhealthyThreshold)
	{
		$this->unhealthyThreshold = $unhealthyThreshold;
	}
}
