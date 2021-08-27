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

class Google_Service_Manager_ReplicaPoolModule extends Google_Collection
{
	public $healthChecks;
	public $numReplicas;
	public $resourceView;
	protected $collection_key = 'healthChecks';
	protected $envVariablesType = 'Google_Service_Manager_EnvVariable';
	protected $envVariablesDataType = 'map';
	protected $replicaPoolParamsType = 'Google_Service_Manager_ReplicaPoolParams';
	protected $replicaPoolParamsDataType = '';
	
	public function setEnvVariables($envVariables)
	{
		$this->envVariables = $envVariables;
	}
	
	public function getEnvVariables()
	{
		return $this->envVariables;
	}
	
	public function getHealthChecks()
	{
		return $this->healthChecks;
	}
	
	public function setHealthChecks($healthChecks)
	{
		$this->healthChecks = $healthChecks;
	}
	
	public function getNumReplicas()
	{
		return $this->numReplicas;
	}
	
	public function setNumReplicas($numReplicas)
	{
		$this->numReplicas = $numReplicas;
	}
	
	public function setReplicaPoolParams(Google_Service_Manager_ReplicaPoolParams $replicaPoolParams)
	{
		$this->replicaPoolParams = $replicaPoolParams;
	}
	
	public function getReplicaPoolParams()
	{
		return $this->replicaPoolParams;
	}
	
	public function getResourceView()
	{
		return $this->resourceView;
	}
	
	public function setResourceView($resourceView)
	{
		$this->resourceView = $resourceView;
	}
}
