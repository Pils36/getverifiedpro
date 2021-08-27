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

class Google_Service_Games_RoomCreateRequest extends Google_Collection
{
	public $capabilities;
	public $invitedPlayerIds;
	public $kind;
	public $requestId;
	public $variant;
	protected $collection_key = 'invitedPlayerIds';
	protected $autoMatchingCriteriaType = 'Google_Service_Games_RoomAutoMatchingCriteria';
	protected $autoMatchingCriteriaDataType = '';
	protected $clientAddressType = 'Google_Service_Games_RoomClientAddress';
	protected $clientAddressDataType = '';
	protected $networkDiagnosticsType = 'Google_Service_Games_NetworkDiagnostics';
	protected $networkDiagnosticsDataType = '';
	
	/**
	 * @param Google_Service_Games_RoomAutoMatchingCriteria
	 */
	public function setAutoMatchingCriteria(Google_Service_Games_RoomAutoMatchingCriteria $autoMatchingCriteria)
	{
		$this->autoMatchingCriteria = $autoMatchingCriteria;
	}
	
	/**
	 * @return Google_Service_Games_RoomAutoMatchingCriteria
	 */
	public function getAutoMatchingCriteria()
	{
		return $this->autoMatchingCriteria;
	}
	
	public function getCapabilities()
	{
		return $this->capabilities;
	}
	
	public function setCapabilities($capabilities)
	{
		$this->capabilities = $capabilities;
	}
	
	/**
	 * @param Google_Service_Games_RoomClientAddress
	 */
	public function setClientAddress(Google_Service_Games_RoomClientAddress $clientAddress)
	{
		$this->clientAddress = $clientAddress;
	}
	
	/**
	 * @return Google_Service_Games_RoomClientAddress
	 */
	public function getClientAddress()
	{
		return $this->clientAddress;
	}
	
	public function getInvitedPlayerIds()
	{
		return $this->invitedPlayerIds;
	}
	
	public function setInvitedPlayerIds($invitedPlayerIds)
	{
		$this->invitedPlayerIds = $invitedPlayerIds;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	/**
	 * @param Google_Service_Games_NetworkDiagnostics
	 */
	public function setNetworkDiagnostics(Google_Service_Games_NetworkDiagnostics $networkDiagnostics)
	{
		$this->networkDiagnostics = $networkDiagnostics;
	}
	
	/**
	 * @return Google_Service_Games_NetworkDiagnostics
	 */
	public function getNetworkDiagnostics()
	{
		return $this->networkDiagnostics;
	}
	
	public function getRequestId()
	{
		return $this->requestId;
	}
	
	public function setRequestId($requestId)
	{
		$this->requestId = $requestId;
	}
	
	public function getVariant()
	{
		return $this->variant;
	}
	
	public function setVariant($variant)
	{
		$this->variant = $variant;
	}
}
