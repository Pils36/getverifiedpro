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

class Google_Service_YouTube_CaptionSnippet extends Google_Model
{
	public $audioTrackType;
	public $failureReason;
	public $isAutoSynced;
	public $isCC;
	public $isDraft;
	public $isEasyReader;
	public $isLarge;
	public $language;
	public $lastUpdated;
	public $name;
	public $status;
	public $trackKind;
	public $videoId;
	
	public function getAudioTrackType()
	{
		return $this->audioTrackType;
	}
	
	public function setAudioTrackType($audioTrackType)
	{
		$this->audioTrackType = $audioTrackType;
	}
	
	public function getFailureReason()
	{
		return $this->failureReason;
	}
	
	public function setFailureReason($failureReason)
	{
		$this->failureReason = $failureReason;
	}
	
	public function getIsAutoSynced()
	{
		return $this->isAutoSynced;
	}
	
	public function setIsAutoSynced($isAutoSynced)
	{
		$this->isAutoSynced = $isAutoSynced;
	}
	
	public function getIsCC()
	{
		return $this->isCC;
	}
	
	public function setIsCC($isCC)
	{
		$this->isCC = $isCC;
	}
	
	public function getIsDraft()
	{
		return $this->isDraft;
	}
	
	public function setIsDraft($isDraft)
	{
		$this->isDraft = $isDraft;
	}
	
	public function getIsEasyReader()
	{
		return $this->isEasyReader;
	}
	
	public function setIsEasyReader($isEasyReader)
	{
		$this->isEasyReader = $isEasyReader;
	}
	
	public function getIsLarge()
	{
		return $this->isLarge;
	}
	
	public function setIsLarge($isLarge)
	{
		$this->isLarge = $isLarge;
	}
	
	public function getLanguage()
	{
		return $this->language;
	}
	
	public function setLanguage($language)
	{
		$this->language = $language;
	}
	
	public function getLastUpdated()
	{
		return $this->lastUpdated;
	}
	
	public function setLastUpdated($lastUpdated)
	{
		$this->lastUpdated = $lastUpdated;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function getTrackKind()
	{
		return $this->trackKind;
	}
	
	public function setTrackKind($trackKind)
	{
		$this->trackKind = $trackKind;
	}
	
	public function getVideoId()
	{
		return $this->videoId;
	}
	
	public function setVideoId($videoId)
	{
		$this->videoId = $videoId;
	}
}
