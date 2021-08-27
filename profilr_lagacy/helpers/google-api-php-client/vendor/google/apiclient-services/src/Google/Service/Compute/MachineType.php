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

class Google_Service_Compute_MachineType extends Google_Collection
{
	public $creationTimestamp;
	public $description;
	public $guestCpus;
	public $id;
	public $imageSpaceGb;
	public $isSharedCpu;
	public $kind;
	public $maximumPersistentDisks;
	public $maximumPersistentDisksSizeGb;
	public $memoryMb;
	public $name;
	public $selfLink;
	public $zone;
	protected $collection_key = 'scratchDisks';
	protected $deprecatedType = 'Google_Service_Compute_DeprecationStatus';
	protected $deprecatedDataType = '';
	protected $scratchDisksType = 'Google_Service_Compute_MachineTypeScratchDisks';
	protected $scratchDisksDataType = 'array';
	
	public function getCreationTimestamp()
	{
		return $this->creationTimestamp;
	}
	
	public function setCreationTimestamp($creationTimestamp)
	{
		$this->creationTimestamp = $creationTimestamp;
	}
	
	/**
	 * @param Google_Service_Compute_DeprecationStatus
	 */
	public function setDeprecated(Google_Service_Compute_DeprecationStatus $deprecated)
	{
		$this->deprecated = $deprecated;
	}
	
	/**
	 * @return Google_Service_Compute_DeprecationStatus
	 */
	public function getDeprecated()
	{
		return $this->deprecated;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getGuestCpus()
	{
		return $this->guestCpus;
	}
	
	public function setGuestCpus($guestCpus)
	{
		$this->guestCpus = $guestCpus;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getImageSpaceGb()
	{
		return $this->imageSpaceGb;
	}
	
	public function setImageSpaceGb($imageSpaceGb)
	{
		$this->imageSpaceGb = $imageSpaceGb;
	}
	
	public function getIsSharedCpu()
	{
		return $this->isSharedCpu;
	}
	
	public function setIsSharedCpu($isSharedCpu)
	{
		$this->isSharedCpu = $isSharedCpu;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	public function getMaximumPersistentDisks()
	{
		return $this->maximumPersistentDisks;
	}
	
	public function setMaximumPersistentDisks($maximumPersistentDisks)
	{
		$this->maximumPersistentDisks = $maximumPersistentDisks;
	}
	
	public function getMaximumPersistentDisksSizeGb()
	{
		return $this->maximumPersistentDisksSizeGb;
	}
	
	public function setMaximumPersistentDisksSizeGb($maximumPersistentDisksSizeGb)
	{
		$this->maximumPersistentDisksSizeGb = $maximumPersistentDisksSizeGb;
	}
	
	public function getMemoryMb()
	{
		return $this->memoryMb;
	}
	
	public function setMemoryMb($memoryMb)
	{
		$this->memoryMb = $memoryMb;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	/**
	 * @param Google_Service_Compute_MachineTypeScratchDisks
	 */
	public function setScratchDisks($scratchDisks)
	{
		$this->scratchDisks = $scratchDisks;
	}
	
	/**
	 * @return Google_Service_Compute_MachineTypeScratchDisks
	 */
	public function getScratchDisks()
	{
		return $this->scratchDisks;
	}
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
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
