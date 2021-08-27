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

class Google_Service_Books_VolumeUserInfo extends Google_Model
{
	public $acquiredTime;
	public $acquisitionType;
	public $entitlementType;
	public $isFamilySharedFromUser;
	public $isFamilySharedToUser;
	public $isFamilySharingAllowed;
	public $isFamilySharingDisabledByFop;
	public $isInMyBooks;
	public $isPreordered;
	public $isPurchased;
	public $isUploaded;
	public $rentalState;
	public $updated;
	protected $copyType = 'Google_Service_Books_VolumeUserInfoCopy';
	protected $copyDataType = '';
	protected $familySharingType = 'Google_Service_Books_VolumeUserInfoFamilySharing';
	protected $familySharingDataType = '';
	protected $readingPositionType = 'Google_Service_Books_ReadingPosition';
	protected $readingPositionDataType = '';
	protected $rentalPeriodType = 'Google_Service_Books_VolumeUserInfoRentalPeriod';
	protected $rentalPeriodDataType = '';
	protected $reviewType = 'Google_Service_Books_Review';
	protected $reviewDataType = '';
	protected $userUploadedVolumeInfoType = 'Google_Service_Books_VolumeUserInfoUserUploadedVolumeInfo';
	protected $userUploadedVolumeInfoDataType = '';
	
	public function getAcquiredTime()
	{
		return $this->acquiredTime;
	}
	
	public function setAcquiredTime($acquiredTime)
	{
		$this->acquiredTime = $acquiredTime;
	}
	
	public function getAcquisitionType()
	{
		return $this->acquisitionType;
	}
	
	public function setAcquisitionType($acquisitionType)
	{
		$this->acquisitionType = $acquisitionType;
	}
	
	/**
	 * @param Google_Service_Books_VolumeUserInfoCopy
	 */
	public function setCopy(Google_Service_Books_VolumeUserInfoCopy $copy)
	{
		$this->copy = $copy;
	}
	
	/**
	 * @return Google_Service_Books_VolumeUserInfoCopy
	 */
	public function getCopy()
	{
		return $this->copy;
	}
	
	public function getEntitlementType()
	{
		return $this->entitlementType;
	}
	
	public function setEntitlementType($entitlementType)
	{
		$this->entitlementType = $entitlementType;
	}
	
	/**
	 * @param Google_Service_Books_VolumeUserInfoFamilySharing
	 */
	public function setFamilySharing(Google_Service_Books_VolumeUserInfoFamilySharing $familySharing)
	{
		$this->familySharing = $familySharing;
	}
	
	/**
	 * @return Google_Service_Books_VolumeUserInfoFamilySharing
	 */
	public function getFamilySharing()
	{
		return $this->familySharing;
	}
	
	public function getIsFamilySharedFromUser()
	{
		return $this->isFamilySharedFromUser;
	}
	
	public function setIsFamilySharedFromUser($isFamilySharedFromUser)
	{
		$this->isFamilySharedFromUser = $isFamilySharedFromUser;
	}
	
	public function getIsFamilySharedToUser()
	{
		return $this->isFamilySharedToUser;
	}
	
	public function setIsFamilySharedToUser($isFamilySharedToUser)
	{
		$this->isFamilySharedToUser = $isFamilySharedToUser;
	}
	
	public function getIsFamilySharingAllowed()
	{
		return $this->isFamilySharingAllowed;
	}
	
	public function setIsFamilySharingAllowed($isFamilySharingAllowed)
	{
		$this->isFamilySharingAllowed = $isFamilySharingAllowed;
	}
	
	public function getIsFamilySharingDisabledByFop()
	{
		return $this->isFamilySharingDisabledByFop;
	}
	
	public function setIsFamilySharingDisabledByFop($isFamilySharingDisabledByFop)
	{
		$this->isFamilySharingDisabledByFop = $isFamilySharingDisabledByFop;
	}
	
	public function getIsInMyBooks()
	{
		return $this->isInMyBooks;
	}
	
	public function setIsInMyBooks($isInMyBooks)
	{
		$this->isInMyBooks = $isInMyBooks;
	}
	
	public function getIsPreordered()
	{
		return $this->isPreordered;
	}
	
	public function setIsPreordered($isPreordered)
	{
		$this->isPreordered = $isPreordered;
	}
	
	public function getIsPurchased()
	{
		return $this->isPurchased;
	}
	
	public function setIsPurchased($isPurchased)
	{
		$this->isPurchased = $isPurchased;
	}
	
	public function getIsUploaded()
	{
		return $this->isUploaded;
	}
	
	public function setIsUploaded($isUploaded)
	{
		$this->isUploaded = $isUploaded;
	}
	
	/**
	 * @param Google_Service_Books_ReadingPosition
	 */
	public function setReadingPosition(Google_Service_Books_ReadingPosition $readingPosition)
	{
		$this->readingPosition = $readingPosition;
	}
	
	/**
	 * @return Google_Service_Books_ReadingPosition
	 */
	public function getReadingPosition()
	{
		return $this->readingPosition;
	}
	
	/**
	 * @param Google_Service_Books_VolumeUserInfoRentalPeriod
	 */
	public function setRentalPeriod(Google_Service_Books_VolumeUserInfoRentalPeriod $rentalPeriod)
	{
		$this->rentalPeriod = $rentalPeriod;
	}
	
	/**
	 * @return Google_Service_Books_VolumeUserInfoRentalPeriod
	 */
	public function getRentalPeriod()
	{
		return $this->rentalPeriod;
	}
	
	public function getRentalState()
	{
		return $this->rentalState;
	}
	
	public function setRentalState($rentalState)
	{
		$this->rentalState = $rentalState;
	}
	
	/**
	 * @param Google_Service_Books_Review
	 */
	public function setReview(Google_Service_Books_Review $review)
	{
		$this->review = $review;
	}
	
	/**
	 * @return Google_Service_Books_Review
	 */
	public function getReview()
	{
		return $this->review;
	}
	
	public function getUpdated()
	{
		return $this->updated;
	}
	
	public function setUpdated($updated)
	{
		$this->updated = $updated;
	}
	
	/**
	 * @param Google_Service_Books_VolumeUserInfoUserUploadedVolumeInfo
	 */
	public function setUserUploadedVolumeInfo(Google_Service_Books_VolumeUserInfoUserUploadedVolumeInfo $userUploadedVolumeInfo)
	{
		$this->userUploadedVolumeInfo = $userUploadedVolumeInfo;
	}
	
	/**
	 * @return Google_Service_Books_VolumeUserInfoUserUploadedVolumeInfo
	 */
	public function getUserUploadedVolumeInfo()
	{
		return $this->userUploadedVolumeInfo;
	}
}
