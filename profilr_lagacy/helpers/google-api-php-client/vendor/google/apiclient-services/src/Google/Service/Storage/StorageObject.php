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

class Google_Service_Storage_StorageObject extends Google_Collection
{
	public $bucket;
	public $cacheControl;
	public $componentCount;
	public $contentDisposition;
	public $contentEncoding;
	public $contentLanguage;
	public $contentType;
	public $crc32c;
	public $etag;
	public $generation;
	public $id;
	public $kind;
	public $kmsKeyName;
	public $md5Hash;
	public $mediaLink;
	public $metadata;
	public $metageneration;
	public $name;
	public $selfLink;
	public $size;
	public $storageClass;
	public $timeCreated;
	public $timeDeleted;
	public $timeStorageClassUpdated;
	public $updated;
	protected $collection_key = 'acl';
	protected $aclType = 'Google_Service_Storage_ObjectAccessControl';
	protected $aclDataType = 'array';
	protected $customerEncryptionType = 'Google_Service_Storage_StorageObjectCustomerEncryption';
	protected $customerEncryptionDataType = '';
	protected $ownerType = 'Google_Service_Storage_StorageObjectOwner';
	protected $ownerDataType = '';
	
	/**
	 * @param Google_Service_Storage_ObjectAccessControl
	 */
	public function setAcl($acl)
	{
		$this->acl = $acl;
	}
	
	/**
	 * @return Google_Service_Storage_ObjectAccessControl
	 */
	public function getAcl()
	{
		return $this->acl;
	}
	
	public function getBucket()
	{
		return $this->bucket;
	}
	
	public function setBucket($bucket)
	{
		$this->bucket = $bucket;
	}
	
	public function getCacheControl()
	{
		return $this->cacheControl;
	}
	
	public function setCacheControl($cacheControl)
	{
		$this->cacheControl = $cacheControl;
	}
	
	public function getComponentCount()
	{
		return $this->componentCount;
	}
	
	public function setComponentCount($componentCount)
	{
		$this->componentCount = $componentCount;
	}
	
	public function getContentDisposition()
	{
		return $this->contentDisposition;
	}
	
	public function setContentDisposition($contentDisposition)
	{
		$this->contentDisposition = $contentDisposition;
	}
	
	public function getContentEncoding()
	{
		return $this->contentEncoding;
	}
	
	public function setContentEncoding($contentEncoding)
	{
		$this->contentEncoding = $contentEncoding;
	}
	
	public function getContentLanguage()
	{
		return $this->contentLanguage;
	}
	
	public function setContentLanguage($contentLanguage)
	{
		$this->contentLanguage = $contentLanguage;
	}
	
	public function getContentType()
	{
		return $this->contentType;
	}
	
	public function setContentType($contentType)
	{
		$this->contentType = $contentType;
	}
	
	public function getCrc32c()
	{
		return $this->crc32c;
	}
	
	public function setCrc32c($crc32c)
	{
		$this->crc32c = $crc32c;
	}
	
	/**
	 * @param Google_Service_Storage_StorageObjectCustomerEncryption
	 */
	public function setCustomerEncryption(Google_Service_Storage_StorageObjectCustomerEncryption $customerEncryption)
	{
		$this->customerEncryption = $customerEncryption;
	}
	
	/**
	 * @return Google_Service_Storage_StorageObjectCustomerEncryption
	 */
	public function getCustomerEncryption()
	{
		return $this->customerEncryption;
	}
	
	public function getEtag()
	{
		return $this->etag;
	}
	
	public function setEtag($etag)
	{
		$this->etag = $etag;
	}
	
	public function getGeneration()
	{
		return $this->generation;
	}
	
	public function setGeneration($generation)
	{
		$this->generation = $generation;
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
	
	public function getKmsKeyName()
	{
		return $this->kmsKeyName;
	}
	
	public function setKmsKeyName($kmsKeyName)
	{
		$this->kmsKeyName = $kmsKeyName;
	}
	
	public function getMd5Hash()
	{
		return $this->md5Hash;
	}
	
	public function setMd5Hash($md5Hash)
	{
		$this->md5Hash = $md5Hash;
	}
	
	public function getMediaLink()
	{
		return $this->mediaLink;
	}
	
	public function setMediaLink($mediaLink)
	{
		$this->mediaLink = $mediaLink;
	}
	
	public function getMetadata()
	{
		return $this->metadata;
	}
	
	public function setMetadata($metadata)
	{
		$this->metadata = $metadata;
	}
	
	public function getMetageneration()
	{
		return $this->metageneration;
	}
	
	public function setMetageneration($metageneration)
	{
		$this->metageneration = $metageneration;
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
	 * @param Google_Service_Storage_StorageObjectOwner
	 */
	public function setOwner(Google_Service_Storage_StorageObjectOwner $owner)
	{
		$this->owner = $owner;
	}
	
	/**
	 * @return Google_Service_Storage_StorageObjectOwner
	 */
	public function getOwner()
	{
		return $this->owner;
	}
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
	}
	
	public function getSize()
	{
		return $this->size;
	}
	
	public function setSize($size)
	{
		$this->size = $size;
	}
	
	public function getStorageClass()
	{
		return $this->storageClass;
	}
	
	public function setStorageClass($storageClass)
	{
		$this->storageClass = $storageClass;
	}
	
	public function getTimeCreated()
	{
		return $this->timeCreated;
	}
	
	public function setTimeCreated($timeCreated)
	{
		$this->timeCreated = $timeCreated;
	}
	
	public function getTimeDeleted()
	{
		return $this->timeDeleted;
	}
	
	public function setTimeDeleted($timeDeleted)
	{
		$this->timeDeleted = $timeDeleted;
	}
	
	public function getTimeStorageClassUpdated()
	{
		return $this->timeStorageClassUpdated;
	}
	
	public function setTimeStorageClassUpdated($timeStorageClassUpdated)
	{
		$this->timeStorageClassUpdated = $timeStorageClassUpdated;
	}
	
	public function getUpdated()
	{
		return $this->updated;
	}
	
	public function setUpdated($updated)
	{
		$this->updated = $updated;
	}
}
