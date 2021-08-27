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

class Google_Service_Compute_Snapshot extends Google_Collection
{
	public $creationTimestamp;
	public $description;
	public $diskSizeGb;
	public $id;
	public $kind;
	public $labelFingerprint;
	public $labels;
	public $licenses;
	public $name;
	public $selfLink;
	public $sourceDisk;
	public $sourceDiskId;
	public $status;
	public $storageBytes;
	public $storageBytesStatus;
	protected $collection_key = 'licenses';
	protected $snapshotEncryptionKeyType = 'Google_Service_Compute_CustomerEncryptionKey';
	protected $snapshotEncryptionKeyDataType = '';
	protected $sourceDiskEncryptionKeyType = 'Google_Service_Compute_CustomerEncryptionKey';
	protected $sourceDiskEncryptionKeyDataType = '';
	
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
	
	public function getDiskSizeGb()
	{
		return $this->diskSizeGb;
	}
	
	public function setDiskSizeGb($diskSizeGb)
	{
		$this->diskSizeGb = $diskSizeGb;
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
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
	}
	
	/**
	 * @param Google_Service_Compute_CustomerEncryptionKey
	 */
	public function setSnapshotEncryptionKey(Google_Service_Compute_CustomerEncryptionKey $snapshotEncryptionKey)
	{
		$this->snapshotEncryptionKey = $snapshotEncryptionKey;
	}
	
	/**
	 * @return Google_Service_Compute_CustomerEncryptionKey
	 */
	public function getSnapshotEncryptionKey()
	{
		return $this->snapshotEncryptionKey;
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
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function getStorageBytes()
	{
		return $this->storageBytes;
	}
	
	public function setStorageBytes($storageBytes)
	{
		$this->storageBytes = $storageBytes;
	}
	
	public function getStorageBytesStatus()
	{
		return $this->storageBytesStatus;
	}
	
	public function setStorageBytesStatus($storageBytesStatus)
	{
		$this->storageBytesStatus = $storageBytesStatus;
	}
}
