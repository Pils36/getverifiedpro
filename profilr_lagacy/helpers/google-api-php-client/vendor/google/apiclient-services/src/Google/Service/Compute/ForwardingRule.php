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

class Google_Service_Compute_ForwardingRule extends Google_Collection
{
	public $iPAddress;
	public $iPProtocol;
	public $backendService;
	public $creationTimestamp;
	public $description;
	public $id;
	public $ipVersion;
	public $kind;
	public $loadBalancingScheme;
	public $name;
	public $network;
	public $portRange;
	public $ports;
	public $region;
	public $selfLink;
	public $subnetwork;
	public $target;
	protected $collection_key = 'ports';
	protected $internal_gapi_mappings = array(
		"iPAddress" => "IPAddress",
		"iPProtocol" => "IPProtocol",
	);
	
	public function getIPAddress()
	{
		return $this->iPAddress;
	}
	
	public function setIPAddress($iPAddress)
	{
		$this->iPAddress = $iPAddress;
	}
	
	public function getIPProtocol()
	{
		return $this->iPProtocol;
	}
	
	public function setIPProtocol($iPProtocol)
	{
		$this->iPProtocol = $iPProtocol;
	}
	
	public function getBackendService()
	{
		return $this->backendService;
	}
	
	public function setBackendService($backendService)
	{
		$this->backendService = $backendService;
	}
	
	public function getCreationTimestamp()
	{
		return $this->creationTimestamp;
	}
	
	public function setCreationTimestamp($creationTimestamp)
	{
		$this->creationTimestamp = $creationTimestamp;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getIpVersion()
	{
		return $this->ipVersion;
	}
	
	public function setIpVersion($ipVersion)
	{
		$this->ipVersion = $ipVersion;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	public function getLoadBalancingScheme()
	{
		return $this->loadBalancingScheme;
	}
	
	public function setLoadBalancingScheme($loadBalancingScheme)
	{
		$this->loadBalancingScheme = $loadBalancingScheme;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getNetwork()
	{
		return $this->network;
	}
	
	public function setNetwork($network)
	{
		$this->network = $network;
	}
	
	public function getPortRange()
	{
		return $this->portRange;
	}
	
	public function setPortRange($portRange)
	{
		$this->portRange = $portRange;
	}
	
	public function getPorts()
	{
		return $this->ports;
	}
	
	public function setPorts($ports)
	{
		$this->ports = $ports;
	}
	
	public function getRegion()
	{
		return $this->region;
	}
	
	public function setRegion($region)
	{
		$this->region = $region;
	}
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
	}
	
	public function getSubnetwork()
	{
		return $this->subnetwork;
	}
	
	public function setSubnetwork($subnetwork)
	{
		$this->subnetwork = $subnetwork;
	}
	
	public function getTarget()
	{
		return $this->target;
	}
	
	public function setTarget($target)
	{
		$this->target = $target;
	}
}
