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

class Google_Service_Manager_ReplicaPoolParamsV1Beta1 extends Google_Collection
{
	public $autoRestart;
	public $baseInstanceName;
	public $canIpForward;
	public $description;
	public $initAction;
	public $machineType;
	public $onHostMaintenance;
	public $zone;
	protected $collection_key = 'serviceAccounts';
	protected $disksToAttachType = 'Google_Service_Manager_ExistingDisk';
	protected $disksToAttachDataType = 'array';
	protected $disksToCreateType = 'Google_Service_Manager_NewDisk';
	protected $disksToCreateDataType = 'array';
	protected $metadataType = 'Google_Service_Manager_Metadata';
	protected $metadataDataType = '';
	protected $networkInterfacesType = 'Google_Service_Manager_NetworkInterface';
	protected $networkInterfacesDataType = 'array';
	protected $serviceAccountsType = 'Google_Service_Manager_ServiceAccount';
	protected $serviceAccountsDataType = 'array';
	protected $tagsType = 'Google_Service_Manager_Tag';
	protected $tagsDataType = '';
	
	public function getAutoRestart()
	{
		return $this->autoRestart;
	}
	
	public function setAutoRestart($autoRestart)
	{
		$this->autoRestart = $autoRestart;
	}
	
	public function getBaseInstanceName()
	{
		return $this->baseInstanceName;
	}
	
	public function setBaseInstanceName($baseInstanceName)
	{
		$this->baseInstanceName = $baseInstanceName;
	}
	
	public function getCanIpForward()
	{
		return $this->canIpForward;
	}
	
	public function setCanIpForward($canIpForward)
	{
		$this->canIpForward = $canIpForward;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function setDisksToAttach($disksToAttach)
	{
		$this->disksToAttach = $disksToAttach;
	}
	
	public function getDisksToAttach()
	{
		return $this->disksToAttach;
	}
	
	public function setDisksToCreate($disksToCreate)
	{
		$this->disksToCreate = $disksToCreate;
	}
	
	public function getDisksToCreate()
	{
		return $this->disksToCreate;
	}
	
	public function getInitAction()
	{
		return $this->initAction;
	}
	
	public function setInitAction($initAction)
	{
		$this->initAction = $initAction;
	}
	
	public function getMachineType()
	{
		return $this->machineType;
	}
	
	public function setMachineType($machineType)
	{
		$this->machineType = $machineType;
	}
	
	public function setMetadata(Google_Service_Manager_Metadata $metadata)
	{
		$this->metadata = $metadata;
	}
	
	public function getMetadata()
	{
		return $this->metadata;
	}
	
	public function setNetworkInterfaces($networkInterfaces)
	{
		$this->networkInterfaces = $networkInterfaces;
	}
	
	public function getNetworkInterfaces()
	{
		return $this->networkInterfaces;
	}
	
	public function getOnHostMaintenance()
	{
		return $this->onHostMaintenance;
	}
	
	public function setOnHostMaintenance($onHostMaintenance)
	{
		$this->onHostMaintenance = $onHostMaintenance;
	}
	
	public function setServiceAccounts($serviceAccounts)
	{
		$this->serviceAccounts = $serviceAccounts;
	}
	
	public function getServiceAccounts()
	{
		return $this->serviceAccounts;
	}
	
	public function setTags(Google_Service_Manager_Tag $tags)
	{
		$this->tags = $tags;
	}
	
	public function getTags()
	{
		return $this->tags;
	}
	
	public function getZone()
	{
		return $this->zone;
	}
	
	public function setZone($zone)
	{
		$this->zone = $zone;
	}
}
