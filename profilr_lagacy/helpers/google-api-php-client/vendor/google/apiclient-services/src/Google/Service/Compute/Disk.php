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

class Google_Service_Compute_Disk extends Google_Collection
{
	public $creationTimestamp;
	public $description;
	public $id;
	public $kind;
	public $labelFingerprint;
	public $labels;
	public $lastAttachTimestamp;
	public $lastDetachTimestamp;
	public $licenses;
	public $name;
	public $options;
	public $selfLink;
	public $sizeGb;
	public $sourceImage;
	public $sourceImageId;
	public $sourceSnapshot;
	public $sourceSnapshotId;
	public $status;
	public $type;
	public $users;
	public $zone;
	protected $collection_key = 'users';
	protected $diskEncryptionKeyType = 'Google_Service_Compute_CustomerEncryptionKey';
	protected $diskEncryptionKeyDataType = '';
	protected $sourceImageEncryptionKeyType = 'Google_Service_Compute_CustomerEncryptionKey';
	protected $sourceImageEncryptionKeyDataType = '';
	protected $sourceSnapshotEncryptionKeyType = 'Google_Service_Compute_CustomerEncryptionKey';
	protected $sourceSnapshotEncryptionKeyDataType = '';
	
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
	
	/**
	 * @param Google_Service_Compute_CustomerEncryptionKey
	 */
	public function setDiskEncryptionKey(Google_Service_Compute_CustomerEncryptionKey $diskEncryptionKey)
	{
		$this->diskEncryptionKey = $diskEncryptionKey;
	}
	
	/**
	 * @return Google_Service_Compute_CustomerEncryptionKey
	 */
	public function getDiskEncryptionKey()
	{
		return $this->diskEncryptionKey;
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
	
	public function getLastAttachTimestamp()
	{
		return $this->lastAttachTimestamp;
	}
	
	public function setLastAttachTimestamp($lastAttachTimestamp)
	{
		$this->lastAttachTimestamp = $lastAttachTimestamp;
	}
	
	public function getLastDetachTimestamp()
	{
		return $this->lastDetachTimestamp;
	}
	
	public function setLastDetachTimestamp($lastDetachTimestamp)
	{
		$this->lastDetachTimestamp = $lastDetachTimestamp;
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
	
	public function getOptions()
	{
		return $this->options;
	}
	
	public function setOptions($options)
	{
		$this->options = $options;
	}
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
	}
	
	public function getSizeGb()
	{
		return $this->sizeGb;
	}
	
	public function setSizeGb($sizeGb)
	{
		$this->sizeGb = $sizeGb;
	}
	
	public function getSourceImage()
	{
		return $this->sourceImage;
	}
	
	public function setSourceImage($sourceImage)
	{
		$this->sourceImage = $sourceImage;
	}
	
	/**
	 * @param Google_Service_Compute_CustomerEncryptionKey
	 */
	public function setSourceImageEncryptionKey(Google_Service_Compute_CustomerEncryptionKey $sourceImageEncryptionKey)
	{
		$this->sourceImageEncryptionKey = $sourceImageEncryptionKey;
	}
	
	/**
	 * @return Google_Service_Compute_CustomerEncryptionKey
	 */
	public function getSourceImageEncryptionKey()
	{
		return $this->sourceImageEncryptionKey;
	}
	
	public function getSourceImageId()
	{
		return $this->sourceImageId;
	}
	
	public function setSourceImageId($sourceImageId)
	{
		$this->sourceImageId = $sourceImageId;
	}
	
	public function getSourceSnapshot()
	{
		return $this->sourceSnapshot;
	}
	
	public function setSourceSnapshot($sourceSnapshot)
	{
		$this->sourceSnapshot = $sourceSnapshot;
	}
	
	/**
	 * @param Google_Service_Compute_CustomerEncryptionKey
	 */
	public function setSourceSnapshotEncryptionKey(Google_Service_Compute_CustomerEncryptionKey $sourceSnapshotEncryptionKey)
	{
		$this->sourceSnapshotEncryptionKey = $sourceSnapshotEncryptionKey;
	}
	
	/**
	 * @return Google_Service_Compute_CustomerEncryptionKey
	 */
	public function getSourceSnapshotEncryptionKey()
	{
		return $this->sourceSnapshotEncryptionKey;
	}
	
	public function getSourceSnapshotId()
	{
		return $this->sourceSnapshotId;
	}
	
	public function setSourceSnapshotId($sourceSnapshotId)
	{
		$this->sourceSnapshotId = $sourceSnapshotId;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function setType($type)
	{
		$this->type = $type;
	}
	
	public function getUsers()
	{
		return $this->users;
	}
	
	public function setUsers($users)
	{
		$this->users = $users;
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
