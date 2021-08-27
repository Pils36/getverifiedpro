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

class Google_Service_Mirror_TimelineItem extends Google_Collection
{
	public $bundleId;
	public $canonicalUrl;
	public $created;
	public $displayTime;
	public $etag;
	public $html;
	public $id;
	public $inReplyTo;
	public $isBundleCover;
	public $isDeleted;
	public $isPinned;
	public $kind;
	public $pinScore;
	public $selfLink;
	public $sourceItemId;
	public $speakableText;
	public $speakableType;
	public $text;
	public $title;
	public $updated;
	protected $collection_key = 'recipients';
	protected $attachmentsType = 'Google_Service_Mirror_Attachment';
	protected $attachmentsDataType = 'array';
	protected $creatorType = 'Google_Service_Mirror_Contact';
	protected $creatorDataType = '';
	protected $locationType = 'Google_Service_Mirror_Location';
	protected $locationDataType = '';
	protected $menuItemsType = 'Google_Service_Mirror_MenuItem';
	protected $menuItemsDataType = 'array';
	protected $notificationType = 'Google_Service_Mirror_NotificationConfig';
	protected $notificationDataType = '';
	protected $recipientsType = 'Google_Service_Mirror_Contact';
	protected $recipientsDataType = 'array';
	
	/**
	 * @param Google_Service_Mirror_Attachment
	 */
	public function setAttachments($attachments)
	{
		$this->attachments = $attachments;
	}
	
	/**
	 * @return Google_Service_Mirror_Attachment
	 */
	public function getAttachments()
	{
		return $this->attachments;
	}
	
	public function getBundleId()
	{
		return $this->bundleId;
	}
	
	public function setBundleId($bundleId)
	{
		$this->bundleId = $bundleId;
	}
	
	public function getCanonicalUrl()
	{
		return $this->canonicalUrl;
	}
	
	public function setCanonicalUrl($canonicalUrl)
	{
		$this->canonicalUrl = $canonicalUrl;
	}
	
	public function getCreated()
	{
		return $this->created;
	}
	
	public function setCreated($created)
	{
		$this->created = $created;
	}
	
	/**
	 * @param Google_Service_Mirror_Contact
	 */
	public function setCreator(Google_Service_Mirror_Contact $creator)
	{
		$this->creator = $creator;
	}
	
	/**
	 * @return Google_Service_Mirror_Contact
	 */
	public function getCreator()
	{
		return $this->creator;
	}
	
	public function getDisplayTime()
	{
		return $this->displayTime;
	}
	
	public function setDisplayTime($displayTime)
	{
		$this->displayTime = $displayTime;
	}
	
	public function getEtag()
	{
		return $this->etag;
	}
	
	public function setEtag($etag)
	{
		$this->etag = $etag;
	}
	
	public function getHtml()
	{
		return $this->html;
	}
	
	public function setHtml($html)
	{
		$this->html = $html;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getInReplyTo()
	{
		return $this->inReplyTo;
	}
	
	public function setInReplyTo($inReplyTo)
	{
		$this->inReplyTo = $inReplyTo;
	}
	
	public function getIsBundleCover()
	{
		return $this->isBundleCover;
	}
	
	public function setIsBundleCover($isBundleCover)
	{
		$this->isBundleCover = $isBundleCover;
	}
	
	public function getIsDeleted()
	{
		return $this->isDeleted;
	}
	
	public function setIsDeleted($isDeleted)
	{
		$this->isDeleted = $isDeleted;
	}
	
	public function getIsPinned()
	{
		return $this->isPinned;
	}
	
	public function setIsPinned($isPinned)
	{
		$this->isPinned = $isPinned;
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
	 * @param Google_Service_Mirror_Location
	 */
	public function setLocation(Google_Service_Mirror_Location $location)
	{
		$this->location = $location;
	}
	
	/**
	 * @return Google_Service_Mirror_Location
	 */
	public function getLocation()
	{
		return $this->location;
	}
	
	/**
	 * @param Google_Service_Mirror_MenuItem
	 */
	public function setMenuItems($menuItems)
	{
		$this->menuItems = $menuItems;
	}
	
	/**
	 * @return Google_Service_Mirror_MenuItem
	 */
	public function getMenuItems()
	{
		return $this->menuItems;
	}
	
	/**
	 * @param Google_Service_Mirror_NotificationConfig
	 */
	public function setNotification(Google_Service_Mirror_NotificationConfig $notification)
	{
		$this->notification = $notification;
	}
	
	/**
	 * @return Google_Service_Mirror_NotificationConfig
	 */
	public function getNotification()
	{
		return $this->notification;
	}
	
	public function getPinScore()
	{
		return $this->pinScore;
	}
	
	public function setPinScore($pinScore)
	{
		$this->pinScore = $pinScore;
	}
	
	/**
	 * @param Google_Service_Mirror_Contact
	 */
	public function setRecipients($recipients)
	{
		$this->recipients = $recipients;
	}
	
	/**
	 * @return Google_Service_Mirror_Contact
	 */
	public function getRecipients()
	{
		return $this->recipients;
	}
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
	}
	
	public function getSourceItemId()
	{
		return $this->sourceItemId;
	}
	
	public function setSourceItemId($sourceItemId)
	{
		$this->sourceItemId = $sourceItemId;
	}
	
	public function getSpeakableText()
	{
		return $this->speakableText;
	}
	
	public function setSpeakableText($speakableText)
	{
		$this->speakableText = $speakableText;
	}
	
	public function getSpeakableType()
	{
		return $this->speakableType;
	}
	
	public function setSpeakableType($speakableType)
	{
		$this->speakableType = $speakableType;
	}
	
	public function getText()
	{
		return $this->text;
	}
	
	public function setText($text)
	{
		$this->text = $text;
	}
	
	public function getTitle()
	{
		return $this->title;
	}
	
	public function setTitle($title)
	{
		$this->title = $title;
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
