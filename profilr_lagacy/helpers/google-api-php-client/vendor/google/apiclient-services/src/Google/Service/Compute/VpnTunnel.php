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

class Google_Service_Compute_VpnTunnel extends Google_Collection
{
	public $creationTimestamp;
	public $description;
	public $detailedStatus;
	public $id;
	public $ikeVersion;
	public $kind;
	public $localTrafficSelector;
	public $name;
	public $peerIp;
	public $region;
	public $remoteTrafficSelector;
	public $router;
	public $selfLink;
	public $sharedSecret;
	public $sharedSecretHash;
	public $status;
	public $targetVpnGateway;
	protected $collection_key = 'remoteTrafficSelector';
	
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
	
	public function getDetailedStatus()
	{
		return $this->detailedStatus;
	}
	
	public function setDetailedStatus($detailedStatus)
	{
		$this->detailedStatus = $detailedStatus;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getIkeVersion()
	{
		return $this->ikeVersion;
	}
	
	public function setIkeVersion($ikeVersion)
	{
		$this->ikeVersion = $ikeVersion;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	public function getLocalTrafficSelector()
	{
		return $this->localTrafficSelector;
	}
	
	public function setLocalTrafficSelector($localTrafficSelector)
	{
		$this->localTrafficSelector = $localTrafficSelector;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getPeerIp()
	{
		return $this->peerIp;
	}
	
	public function setPeerIp($peerIp)
	{
		$this->peerIp = $peerIp;
	}
	
	public function getRegion()
	{
		return $this->region;
	}
	
	public function setRegion($region)
	{
		$this->region = $region;
	}
	
	public function getRemoteTrafficSelector()
	{
		return $this->remoteTrafficSelector;
	}
	
	public function setRemoteTrafficSelector($remoteTrafficSelector)
	{
		$this->remoteTrafficSelector = $remoteTrafficSelector;
	}
	
	public function getRouter()
	{
		return $this->router;
	}
	
	public function setRouter($router)
	{
		$this->router = $router;
	}
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
	}
	
	public function getSharedSecret()
	{
		return $this->sharedSecret;
	}
	
	public function setSharedSecret($sharedSecret)
	{
		$this->sharedSecret = $sharedSecret;
	}
	
	public function getSharedSecretHash()
	{
		return $this->sharedSecretHash;
	}
	
	public function setSharedSecretHash($sharedSecretHash)
	{
		$this->sharedSecretHash = $sharedSecretHash;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function getTargetVpnGateway()
	{
		return $this->targetVpnGateway;
	}
	
	public function setTargetVpnGateway($targetVpnGateway)
	{
		$this->targetVpnGateway = $targetVpnGateway;
	}
}
