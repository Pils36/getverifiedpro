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

class Google_Service_Dns_ManagedZone extends Google_Collection
{
	public $creationTime;
	public $description;
	public $dnsName;
	public $id;
	public $kind;
	public $name;
	public $nameServerSet;
	public $nameServers;
	protected $collection_key = 'nameServers';
	
	public function getCreationTime()
	{
		return $this->creationTime;
	}
	
	public function setCreationTime($creationTime)
	{
		$this->creationTime = $creationTime;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getDnsName()
	{
		return $this->dnsName;
	}
	
	public function setDnsName($dnsName)
	{
		$this->dnsName = $dnsName;
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
	
	public function getNameServerSet()
	{
		return $this->nameServerSet;
	}
	
	public function setNameServerSet($nameServerSet)
	{
		$this->nameServerSet = $nameServerSet;
	}
	
	public function getNameServers()
	{
		return $this->nameServers;
	}
	
	public function setNameServers($nameServers)
	{
		$this->nameServers = $nameServers;
	}
}
