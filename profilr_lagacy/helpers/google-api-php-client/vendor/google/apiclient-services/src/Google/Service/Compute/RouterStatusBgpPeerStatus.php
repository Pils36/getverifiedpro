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

class Google_Service_Compute_RouterStatusBgpPeerStatus extends Google_Collection
{
	public $ipAddress;
	public $linkedVpnTunnel;
	public $name;
	public $numLearnedRoutes;
	public $peerIpAddress;
	public $state;
	public $status;
	public $uptime;
	public $uptimeSeconds;
	protected $collection_key = 'advertisedRoutes';
	protected $advertisedRoutesType = 'Google_Service_Compute_Route';
	protected $advertisedRoutesDataType = 'array';
	
	/**
	 * @param Google_Service_Compute_Route
	 */
	public function setAdvertisedRoutes($advertisedRoutes)
	{
		$this->advertisedRoutes = $advertisedRoutes;
	}
	
	/**
	 * @return Google_Service_Compute_Route
	 */
	public function getAdvertisedRoutes()
	{
		return $this->advertisedRoutes;
	}
	
	public function getIpAddress()
	{
		return $this->ipAddress;
	}
	
	public function setIpAddress($ipAddress)
	{
		$this->ipAddress = $ipAddress;
	}
	
	public function getLinkedVpnTunnel()
	{
		return $this->linkedVpnTunnel;
	}
	
	public function setLinkedVpnTunnel($linkedVpnTunnel)
	{
		$this->linkedVpnTunnel = $linkedVpnTunnel;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getNumLearnedRoutes()
	{
		return $this->numLearnedRoutes;
	}
	
	public function setNumLearnedRoutes($numLearnedRoutes)
	{
		$this->numLearnedRoutes = $numLearnedRoutes;
	}
	
	public function getPeerIpAddress()
	{
		return $this->peerIpAddress;
	}
	
	public function setPeerIpAddress($peerIpAddress)
	{
		$this->peerIpAddress = $peerIpAddress;
	}
	
	public function getState()
	{
		return $this->state;
	}
	
	public function setState($state)
	{
		$this->state = $state;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function getUptime()
	{
		return $this->uptime;
	}
	
	public function setUptime($uptime)
	{
		$this->uptime = $uptime;
	}
	
	public function getUptimeSeconds()
	{
		return $this->uptimeSeconds;
	}
	
	public function setUptimeSeconds($uptimeSeconds)
	{
		$this->uptimeSeconds = $uptimeSeconds;
	}
}
