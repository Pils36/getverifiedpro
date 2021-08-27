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

class Google_Service_Compute_Image extends Google_Collection
{
	public $archiveSizeBytes;
	public $creationTimestamp;
	public $description;
	public $diskSizeGb;
	public $family;
	public $id;
	public $kind;
	public $labelFingerprint;
	public $labels;
	public $licenses;
	public $name;
	public $selfLink;
	public $sourceDisk;
	public $sourceDiskId;
	public $sourceType;
	public $status;
	protected $collection_key = 'licenses';
	protected $deprecatedType = 'Google_Service_Compute_DeprecationStatus';
	protected $deprecatedDataType = '';
	protected $guestOsFeaturesType = 'Google_Service_Compute_GuestOsFeature';
	protected $guestOsFeaturesDataType = 'array';
	protected $imageEncryptionKeyType = 'Google_Service_Compute_CustomerEncryptionKey';
	protected $imageEncryptionKeyDataType = '';
	protected $rawDiskType = 'Google_Service_Compute_ImageRawDisk';
	protected $rawDiskDataType = '';
	protected $sourceDiskEncryptionKeyType = 'Google_Service_Compute_CustomerEncryptionKey';
	protected $sourceDiskEncryptionKeyDataType = '';
	
	public function getArchiveSizeBytes()
	{
		return $this->archiveSizeBytes;
	}
	
	public function setArchiveSizeBytes($archiveSizeBytes)
	{
		$this->archiveSizeBytes = $archiveSizeBytes;
	}
	
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
	
	public function getDiskSizeGb()
	{
		return $this->diskSizeGb;
	}
	
	public function setDiskSizeGb($diskSizeGb)
	{
		$this->diskSizeGb = $diskSizeGb;
	}
	
	public function getFamily()
	{
		return $this->family;
	}
	
	public function setFamily($family)
	{
		$this->family = $family;
	}
	
	/**
	 * @param Google_Service_Compute_GuestOsFeature
	 */
	public function setGuestOsFeatures($guestOsFeatures)
	{
		$this->guestOsFeatures = $guestOsFeatures;
	}
	
	/**
	 * @return Google_Service_Compute_GuestOsFeature
	 */
	public function getGuestOsFeatures()
	{
		return $this->guestOsFeatures;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	/**
	 * @param Google_Service_Compute_CustomerEncryptionKey
	 */
	public function setImageEncryptionKey(Google_Service_Compute_CustomerEncryptionKey $imageEncryptionKey)
	{
		$this->imageEncryptionKey = $imageEncryptionKey;
	}
	
	/**
	 * @return Google_Service_Compute_CustomerEncryptionKey
	 */
	public function getImageEncryptionKey()
	{
		return $this->imageEncryptionKey;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	public function getLabelFingerprint()
	{
		return $this->labelFingerprint;
	}
	
	public function setLabelFingerprint($labelFingerprint)
	{
		$this->labelFingerprint = $labelFingerprint;
	}
	
	public function getLabels()
	{
		return $this->labels;
	}
	
	public function setLabels($labels)
	{
		$this->labels = $labels;
	}
	
	public function getLicenses()
	{
		return $this->licenses;
	}
	
	public function setLicenses($licenses)
	{
		$this->licenses = $licenses;
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
	 * @param Google_Service_Compute_ImageRawDisk
	 */
	public function setRawDisk(Google_Service_Compute_ImageRawDisk $rawDisk)
	{
		$this->rawDisk = $rawDisk;
	}
	
	/**
	 * @return Google_Service_Compute_ImageRawDisk
	 */
	public function getRawDisk()
	{
		return $this->rawDisk;
	}
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
	}
	
	public function getSourceDisk()
	{
		return $this->sourceDisk;
	}
	
	public function setSourceDisk($sourceDisk)
	{
		$this->sourceDisk = $sourceDisk;
	}
	
	/**
	 * @param Google_Service_Compute_CustomerEncryptionKey
	 */
	public function setSourceDiskEncryptionKey(Google_Service_Compute_CustomerEncryptionKey $sourceDiskEncryptionKey)
	{
		$this->sourceDiskEncryptionKey = $sourceDiskEncryptionKey;
	}
	
	/**
	 * @return Google_Service_Compute_CustomerEncryptionKey
	 */
	public function getSourceDiskEncryptionKey()
	{
		return $this->sourceDiskEncryptionKey;
	}
	
	public function getSourceDiskId()
	{
		return $this->sourceDiskId;
	}
	
	public function setSourceDiskId($sourceDiskId)
	{
		$this->sourceDiskId = $sourceDiskId;
	}
	
	public function getSourceType()
	{
		return $this->sourceType;
	}
	
	public function setSourceType($sourceType)
	{
		$this->sourceType = $sourceType;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
}
