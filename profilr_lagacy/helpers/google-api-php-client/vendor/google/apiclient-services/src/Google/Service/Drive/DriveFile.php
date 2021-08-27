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

class Google_Service_Drive_DriveFile extends Google_Collection
{
	public $appProperties;
	public $createdTime;
	public $description;
	public $explicitlyTrashed;
	public $fileExtension;
	public $folderColorRgb;
	public $fullFileExtension;
	public $hasAugmentedPermissions;
	public $hasThumbnail;
	public $headRevisionId;
	public $iconLink;
	public $id;
	public $isAppAuthorized;
	public $kind;
	public $md5Checksum;
	public $mimeType;
	public $modifiedByMe;
	public $modifiedByMeTime;
	public $modifiedTime;
	public $name;
	public $originalFilename;
	public $ownedByMe;
	public $parents;
	public $properties;
	public $quotaBytesUsed;
	public $shared;
	public $sharedWithMeTime;
	public $size;
	public $spaces;
	public $starred;
	public $teamDriveId;
	public $thumbnailLink;
	public $thumbnailVersion;
	public $trashed;
	public $trashedTime;
	public $version;
	public $viewedByMe;
	public $viewedByMeTime;
	public $viewersCanCopyContent;
	public $webContentLink;
	public $webViewLink;
	public $writersCanShare;
	protected $collection_key = 'spaces';
	protected $capabilitiesType = 'Google_Service_Drive_DriveFileCapabilities';
	protected $capabilitiesDataType = '';
	protected $contentHintsType = 'Google_Service_Drive_DriveFileContentHints';
	protected $contentHintsDataType = '';
	protected $imageMediaMetadataType = 'Google_Service_Drive_DriveFileImageMediaMetadata';
	protected $imageMediaMetadataDataType = '';
	protected $lastModifyingUserType = 'Google_Service_Drive_User';
	protected $lastModifyingUserDataType = '';
	protected $ownersType = 'Google_Service_Drive_User';
	protected $ownersDataType = 'array';
	protected $permissionsType = 'Google_Service_Drive_Permission';
	protected $permissionsDataType = 'array';
	protected $sharingUserType = 'Google_Service_Drive_User';
	protected $sharingUserDataType = '';
	protected $trashingUserType = 'Google_Service_Drive_User';
	protected $trashingUserDataType = '';
	protected $videoMediaMetadataType = 'Google_Service_Drive_DriveFileVideoMediaMetadata';
	protected $videoMediaMetadataDataType = '';
	
	public function getAppProperties()
	{
		return $this->appProperties;
	}
	
	public function setAppProperties($appProperties)
	{
		$this->appProperties = $appProperties;
	}
	
	/**
	 * @param Google_Service_Drive_DriveFileCapabilities
	 */
	public function setCapabilities(Google_Service_Drive_DriveFileCapabilities $capabilities)
	{
		$this->capabilities = $capabilities;
	}
	
	/**
	 * @return Google_Service_Drive_DriveFileCapabilities
	 */
	public function getCapabilities()
	{
		return $this->capabilities;
	}
	
	/**
	 * @param Google_Service_Drive_DriveFileContentHints
	 */
	public function setContentHints(Google_Service_Drive_DriveFileContentHints $contentHints)
	{
		$this->contentHints = $contentHints;
	}
	
	/**
	 * @return Google_Service_Drive_DriveFileContentHints
	 */
	public function getContentHints()
	{
		return $this->contentHints;
	}
	
	public function getCreatedTime()
	{
		return $this->createdTime;
	}
	
	public function setCreatedTime($createdTime)
	{
		$this->createdTime = $createdTime;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getExplicitlyTrashed()
	{
		return $this->explicitlyTrashed;
	}
	
	public function setExplicitlyTrashed($explicitlyTrashed)
	{
		$this->explicitlyTrashed = $explicitlyTrashed;
	}
	
	public function getFileExtension()
	{
		return $this->fileExtension;
	}
	
	public function setFileExtension($fileExtension)
	{
		$this->fileExtension = $fileExtension;
	}
	
	public function getFolderColorRgb()
	{
		return $this->folderColorRgb;
	}
	
	public function setFolderColorRgb($folderColorRgb)
	{
		$this->folderColorRgb = $folderColorRgb;
	}
	
	public function getFullFileExtension()
	{
		return $this->fullFileExtension;
	}
	
	public function setFullFileExtension($fullFileExtension)
	{
		$this->fullFileExtension = $fullFileExtension;
	}
	
	public function getHasAugmentedPermissions()
	{
		return $this->hasAugmentedPermissions;
	}
	
	public function setHasAugmentedPermissions($hasAugmentedPermissions)
	{
		$this->hasAugmentedPermissions = $hasAugmentedPermissions;
	}
	
	public function getHasThumbnail()
	{
		return $this->hasThumbnail;
	}
	
	public function setHasThumbnail($hasThumbnail)
	{
		$this->hasThumbnail = $hasThumbnail;
	}
	
	public function getHeadRevisionId()
	{
		return $this->headRevisionId;
	}
	
	public function setHeadRevisionId($headRevisionId)
	{
		$this->headRevisionId = $headRevisionId;
	}
	
	public function getIconLink()
	{
		return $this->iconLink;
	}
	
	public function setIconLink($iconLink)
	{
		$this->iconLink = $iconLink;
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
	 * @param Google_Service_Drive_DriveFileImageMediaMetadata
	 */
	public function setImageMediaMetadata(Google_Service_Drive_DriveFileImageMediaMetadata $imageMediaMetadata)
	{
		$this->imageMediaMetadata = $imageMediaMetadata;
	}
	
	/**
	 * @return Google_Service_Drive_DriveFileImageMediaMetadata
	 */
	public function getImageMediaMetadata()
	{
		return $this->imageMediaMetadata;
	}
	
	public function getIsAppAuthorized()
	{
		return $this->isAppAuthorized;
	}
	
	public function setIsAppAuthorized($isAppAuthorized)
	{
		$this->isAppAuthorized = $isAppAuthorized;
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
	 * @param Google_Service_Drive_User
	 */
	public function setLastModifyingUser(Google_Service_Drive_User $lastModifyingUser)
	{
		$this->lastModifyingUser = $lastModifyingUser;
	}
	
	/**
	 * @return Google_Service_Drive_User
	 */
	public function getLastModifyingUser()
	{
		return $this->lastModifyingUser;
	}
	
	public function getMd5Checksum()
	{
		return $this->md5Checksum;
	}
	
	public function setMd5Checksum($md5Checksum)
	{
		$this->md5Checksum = $md5Checksum;
	}
	
	public function getMimeType()
	{
		return $this->mimeType;
	}
	
	public function setMimeType($mimeType)
	{
		$this->mimeType = $mimeType;
	}
	
	public function getModifiedByMe()
	{
		return $this->modifiedByMe;
	}
	
	public function setModifiedByMe($modifiedByMe)
	{
		$this->modifiedByMe = $modifiedByMe;
	}
	
	public function getModifiedByMeTime()
	{
		return $this->modifiedByMeTime;
	}
	
	public function setModifiedByMeTime($modifiedByMeTime)
	{
		$this->modifiedByMeTime = $modifiedByMeTime;
	}
	
	public function getModifiedTime()
	{
		return $this->modifiedTime;
	}
	
	public function setModifiedTime($modifiedTime)
	{
		$this->modifiedTime = $modifiedTime;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getOriginalFilename()
	{
		return $this->originalFilename;
	}
	
	public function setOriginalFilename($originalFilename)
	{
		$this->originalFilename = $originalFilename;
	}
	
	public function getOwnedByMe()
	{
		return $this->ownedByMe;
	}
	
	public function setOwnedByMe($ownedByMe)
	{
		$this->ownedByMe = $ownedByMe;
	}
	
	/**
	 * @param Google_Service_Drive_User
	 */
	public function setOwners($owners)
	{
		$this->owners = $owners;
	}
	
	/**
	 * @return Google_Service_Drive_User
	 */
	public function getOwners()
	{
		return $this->owners;
	}
	
	public function getParents()
	{
		return $this->parents;
	}
	
	public function setParents($parents)
	{
		$this->parents = $parents;
	}
	
	/**
	 * @param Google_Service_Drive_Permission
	 */
	public function setPermissions($permissions)
	{
		$this->permissions = $permissions;
	}
	
	/**
	 * @return Google_Service_Drive_Permission
	 */
	public function getPermissions()
	{
		return $this->permissions;
	}
	
	public function getProperties()
	{
		return $this->properties;
	}
	
	public function setProperties($properties)
	{
		$this->properties = $properties;
	}
	
	public function getQuotaBytesUsed()
	{
		return $this->quotaBytesUsed;
	}
	
	public function setQuotaBytesUsed($quotaBytesUsed)
	{
		$this->quotaBytesUsed = $quotaBytesUsed;
	}
	
	public function getShared()
	{
		return $this->shared;
	}
	
	public function setShared($shared)
	{
		$this->shared = $shared;
	}
	
	public function getSharedWithMeTime()
	{
		return $this->sharedWithMeTime;
	}
	
	public function setSharedWithMeTime($sharedWithMeTime)
	{
		$this->sharedWithMeTime = $sharedWithMeTime;
	}
	
	/**
	 * @param Google_Service_Drive_User
	 */
	public function setSharingUser(Google_Service_Drive_User $sharingUser)
	{
		$this->sharingUser = $sharingUser;
	}
	
	/**
	 * @return Google_Service_Drive_User
	 */
	public function getSharingUser()
	{
		return $this->sharingUser;
	}
	
	public function getSize()
	{
		return $this->size;
	}
	
	public function setSize($size)
	{
		$this->size = $size;
	}
	
	public function getSpaces()
	{
		return $this->spaces;
	}
	
	public function setSpaces($spaces)
	{
		$this->spaces = $spaces;
	}
	
	public function getStarred()
	{
		return $this->starred;
	}
	
	public function setStarred($starred)
	{
		$this->starred = $starred;
	}
	
	public function getTeamDriveId()
	{
		return $this->teamDriveId;
	}
	
	public function setTeamDriveId($teamDriveId)
	{
		$this->teamDriveId = $teamDriveId;
	}
	
	public function getThumbnailLink()
	{
		return $this->thumbnailLink;
	}
	
	public function setThumbnailLink($thumbnailLink)
	{
		$this->thumbnailLink = $thumbnailLink;
	}
	
	public function getThumbnailVersion()
	{
		return $this->thumbnailVersion;
	}
	
	public function setThumbnailVersion($thumbnailVersion)
	{
		$this->thumbnailVersion = $thumbnailVersion;
	}
	
	public function getTrashed()
	{
		return $this->trashed;
	}
	
	public function setTrashed($trashed)
	{
		$this->trashed = $trashed;
	}
	
	public function getTrashedTime()
	{
		return $this->trashedTime;
	}
	
	public function setTrashedTime($trashedTime)
	{
		$this->trashedTime = $trashedTime;
	}
	
	/**
	 * @param Google_Service_Drive_User
	 */
	public function setTrashingUser(Google_Service_Drive_User $trashingUser)
	{
		$this->trashingUser = $trashingUser;
	}
	
	/**
	 * @return Google_Service_Drive_User
	 */
	public function getTrashingUser()
	{
		return $this->trashingUser;
	}
	
	public function getVersion()
	{
		return $this->version;
	}
	
	public function setVersion($version)
	{
		$this->version = $version;
	}
	
	/**
	 * @param Google_Service_Drive_DriveFileVideoMediaMetadata
	 */
	public function setVideoMediaMetadata(Google_Service_Drive_DriveFileVideoMediaMetadata $videoMediaMetadata)
	{
		$this->videoMediaMetadata = $videoMediaMetadata;
	}
	
	/**
	 * @return Google_Service_Drive_DriveFileVideoMediaMetadata
	 */
	public function getVideoMediaMetadata()
	{
		return $this->videoMediaMetadata;
	}
	
	public function getViewedByMe()
	{
		return $this->viewedByMe;
	}
	
	public function setViewedByMe($viewedByMe)
	{
		$this->viewedByMe = $viewedByMe;
	}
	
	public function getViewedByMeTime()
	{
		return $this->viewedByMeTime;
	}
	
	public function setViewedByMeTime($viewedByMeTime)
	{
		$this->viewedByMeTime = $viewedByMeTime;
	}
	
	public function getViewersCanCopyContent()
	{
		return $this->viewersCanCopyContent;
	}
	
	public function setViewersCanCopyContent($viewersCanCopyContent)
	{
		$this->viewersCanCopyContent = $viewersCanCopyContent;
	}
	
	public function getWebContentLink()
	{
		return $this->webContentLink;
	}
	
	public function setWebContentLink($webContentLink)
	{
		$this->webContentLink = $webContentLink;
	}
	
	public function getWebViewLink()
	{
		return $this->webViewLink;
	}
	
	public function setWebViewLink($webViewLink)
	{
		$this->webViewLink = $webViewLink;
	}
	
	public function getWritersCanShare()
	{
		return $this->writersCanShare;
	}
	
	public function setWritersCanShare($writersCanShare)
	{
		$this->writersCanShare = $writersCanShare;
	}
}
