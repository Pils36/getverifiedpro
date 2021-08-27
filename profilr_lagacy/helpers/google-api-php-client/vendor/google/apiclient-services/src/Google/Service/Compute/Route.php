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

class Google_Service_Compute_Route extends Google_Collection
{
	public $creationTimestamp;
	public $description;
	public $destRange;
	public $id;
	public $kind;
	public $name;
	public $network;
	public $nextHopGateway;
	public $nextHopInstance;
	public $nextHopIp;
	public $nextHopNetwork;
	public $nextHopPeering;
	public $nextHopVpnTunnel;
	public $priority;
	public $selfLink;
	public $tags;
	protected $collection_key = 'warnings';
	protected $warningsType = 'Google_Service_Compute_RouteWarnings';
	protected $warningsDataType = 'array';
	
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
	
	public function getDestRange()
	{
		return $this->destRange;
	}
	
	public function setDestRange($destRange)
	{
		$this->destRange = $destRange;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
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
	
	public function getNextHopGateway()
	{
		return $this->nextHopGateway;
	}
	
	public function setNextHopGateway($nextHopGateway)
	{
		$this->nextHopGateway = $nextHopGateway;
	}
	
	public function getNextHopInstance()
	{
		return $this->nextHopInstance;
	}
	
	public function setNextHopInstance($nextHopInstance)
	{
		$this->nextHopInstance = $nextHopInstance;
	}
	
	public function getNextHopIp()
	{
		return $this->nextHopIp;
	}
	
	public function setNextHopIp($nextHopIp)
	{
		$this->nextHopIp = $nextHopIp;
	}
	
	public function getNextHopNetwork()
	{
		return $this->nextHopNetwork;
	}
	
	public function setNextHopNetwork($nextHopNetwork)
	{
		$this->nextHopNetwork = $nextHopNetwork;
	}
	
	public function getNextHopPeering()
	{
		return $this->nextHopPeering;
	}
	
	public function setNextHopPeering($nextHopPeering)
	{
		$this->nextHopPeering = $nextHopPeering;
	}
	
	public function getNextHopVpnTunnel()
	{
		return $this->nextHopVpnTunnel;
	}
	
	public function setNextHopVpnTunnel($nextHopVpnTunnel)
	{
		$this->nextHopVpnTunnel = $nextHopVpnTunnel;
	}
	
	public function getPriority()
	{
		return $this->priority;
	}
	
	public function setPriority($priority)
	{
		$this->priority = $priority;
	}
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
	}
	
	public function getTags()
	{
		return $this->tags;
	}
	
	public function setTags($tags)
	{
		$this->tags = $tags;
	}
	
	/**
	 * @param Google_Service_Compute_RouteWarnings
	 */
	public function setWarnings($warnings)
	{
		$this->warnings = $warnings;
	}
	
	/**
	 * @return Google_Service_Compute_RouteWarnings
	 */
	public function getWarnings()
	{
		return $this->warnings;
	}
}
