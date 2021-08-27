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

class Google_Service_Storage_BucketAccessControl extends Google_Model
{
	public $bucket;
	public $domain;
	public $email;
	public $entity;
	public $entityId;
	public $etag;
	public $id;
	public $kind;
	public $role;
	public $selfLink;
	protected $projectTeamType = 'Google_Service_Storage_BucketAccessControlProjectTeam';
	protected $projectTeamDataType = '';
	
	public function getBucket()
	{
		return $this->bucket;
	}
	
	public function setBucket($bucket)
	{
		$this->bucket = $bucket;
	}
	
	public function getDomain()
	{
		return $this->domain;
	}
	
	public function setDomain($domain)
	{
		$this->domain = $domain;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	public function getEntity()
	{
		return $this->entity;
	}
	
	public function setEntity($entity)
	{
		$this->entity = $entity;
	}
	
	public function getEntityId()
	{
		return $this->entityId;
	}
	
	public function setEntityId($entityId)
	{
		$this->entityId = $entityId;
	}
	
	public function getEtag()
	{
		return $this->etag;
	}
	
	public function setEtag($etag)
	{
		$this->etag = $etag;
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
	
	/**
	 * @param Google_Service_Storage_BucketAccessControlProjectTeam
	 */
	public function setProjectTeam(Google_Service_Storage_BucketAccessControlProjectTeam $projectTeam)
	{
		$this->projectTeam = $projectTeam;
	}
	
	/**
	 * @return Google_Service_Storage_BucketAccessControlProjectTeam
	 */
	public function getProjectTeam()
	{
		return $this->projectTeam;
	}
	
	public function getRole()
	{
		return $this->role;
	}
	
	public function setRole($role)
	{
		$this->role = $role;
	}
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
	}
}
