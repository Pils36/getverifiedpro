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

class Google_Service_Drive_Permission extends Google_Collection
{
	public $allowFileDiscovery;
	public $deleted;
	public $displayName;
	public $domain;
	public $emailAddress;
	public $expirationTime;
	public $id;
	public $kind;
	public $photoLink;
	public $role;
	public $type;
	protected $collection_key = 'teamDrivePermissionDetails';
	protected $teamDrivePermissionDetailsType = 'Google_Service_Drive_PermissionTeamDrivePermissionDetails';
	protected $teamDrivePermissionDetailsDataType = 'array';
	
	public function getAllowFileDiscovery()
	{
		return $this->allowFileDiscovery;
	}
	
	public function setAllowFileDiscovery($allowFileDiscovery)
	{
		$this->allowFileDiscovery = $allowFileDiscovery;
	}
	
	public function getDeleted()
	{
		return $this->deleted;
	}
	
	public function setDeleted($deleted)
	{
		$this->deleted = $deleted;
	}
	
	public function getDisplayName()
	{
		return $this->displayName;
	}
	
	public function setDisplayName($displayName)
	{
		$this->displayName = $displayName;
	}
	
	public function getDomain()
	{
		return $this->domain;
	}
	
	public function setDomain($domain)
	{
		$this->domain = $domain;
	}
	
	public function getEmailAddress()
	{
		return $this->emailAddress;
	}
	
	public function setEmailAddress($emailAddress)
	{
		$this->emailAddress = $emailAddress;
	}
	
	public function getExpirationTime()
	{
		return $this->expirationTime;
	}
	
	public function setExpirationTime($expirationTime)
	{
		$this->expirationTime = $expirationTime;
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
	
	public function getPhotoLink()
	{
		return $this->photoLink;
	}
	
	public function setPhotoLink($photoLink)
	{
		$this->photoLink = $photoLink;
	}
	
	public function getRole()
	{
		return $this->role;
	}
	
	public function setRole($role)
	{
		$this->role = $role;
	}
	
	/**
	 * @param Google_Service_Drive_PermissionTeamDrivePermissionDetails
	 */
	public function setTeamDrivePermissionDetails($teamDrivePermissionDetails)
	{
		$this->teamDrivePermissionDetails = $teamDrivePermissionDetails;
	}
	
	/**
	 * @return Google_Service_Drive_PermissionTeamDrivePermissionDetails
	 */
	public function getTeamDrivePermissionDetails()
	{
		return $this->teamDrivePermissionDetails;
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function setType($type)
	{
		$this->type = $type;
	}
}
