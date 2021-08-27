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

class Google_Service_Games_Room extends Google_Collection
{
	public $applicationId;
	public $description;
	public $inviterId;
	public $kind;
	public $roomId;
	public $roomStatusVersion;
	public $status;
	public $variant;
	protected $collection_key = 'participants';
	protected $autoMatchingCriteriaType = 'Google_Service_Games_RoomAutoMatchingCriteria';
	protected $autoMatchingCriteriaDataType = '';
	protected $autoMatchingStatusType = 'Google_Service_Games_RoomAutoMatchStatus';
	protected $autoMatchingStatusDataType = '';
	protected $creationDetailsType = 'Google_Service_Games_RoomModification';
	protected $creationDetailsDataType = '';
	protected $lastUpdateDetailsType = 'Google_Service_Games_RoomModification';
	protected $lastUpdateDetailsDataType = '';
	protected $participantsType = 'Google_Service_Games_RoomParticipant';
	protected $participantsDataType = 'array';
	
	public function getApplicationId()
	{
		return $this->applicationId;
	}
	
	public function setApplicationId($applicationId)
	{
		$this->applicationId = $applicationId;
	}
	
	/**
	 * @param Google_Service_Games_RoomAutoMatchingCriteria
	 */
	public function setAutoMatchingCriteria(Google_Service_Games_RoomAutoMatchingCriteria $autoMatchingCriteria)
	{
		$this->autoMatchingCriteria = $autoMatchingCriteria;
	}
	
	/**
	 * @return Google_Service_Games_RoomAutoMatchingCriteria
	 */
	public function getAutoMatchingCriteria()
	{
		return $this->autoMatchingCriteria;
	}
	
	/**
	 * @param Google_Service_Games_RoomAutoMatchStatus
	 */
	public function setAutoMatchingStatus(Google_Service_Games_RoomAutoMatchStatus $autoMatchingStatus)
	{
		$this->autoMatchingStatus = $autoMatchingStatus;
	}
	
	/**
	 * @return Google_Service_Games_RoomAutoMatchStatus
	 */
	public function getAutoMatchingStatus()
	{
		return $this->autoMatchingStatus;
	}
	
	/**
	 * @param Google_Service_Games_RoomModification
	 */
	public function setCreationDetails(Google_Service_Games_RoomModification $creationDetails)
	{
		$this->creationDetails = $creationDetails;
	}
	
	/**
	 * @return Google_Service_Games_RoomModification
	 */
	public function getCreationDetails()
	{
		return $this->creationDetails;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getInviterId()
	{
		return $this->inviterId;
	}
	
	public function setInviterId($inviterId)
	{
		$this->inviterId = $inviterId;
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
	 * @param Google_Service_Games_RoomModification
	 */
	public function setLastUpdateDetails(Google_Service_Games_RoomModification $lastUpdateDetails)
	{
		$this->lastUpdateDetails = $lastUpdateDetails;
	}
	
	/**
	 * @return Google_Service_Games_RoomModification
	 */
	public function getLastUpdateDetails()
	{
		return $this->lastUpdateDetails;
	}
	
	/**
	 * @param Google_Service_Games_RoomParticipant
	 */
	public function setParticipants($participants)
	{
		$this->participants = $participants;
	}
	
	/**
	 * @return Google_Service_Games_RoomParticipant
	 */
	public function getParticipants()
	{
		return $this->participants;
	}
	
	public function getRoomId()
	{
		return $this->roomId;
	}
	
	public function setRoomId($roomId)
	{
		$this->roomId = $roomId;
	}
	
	public function getRoomStatusVersion()
	{
		return $this->roomStatusVersion;
	}
	
	public function setRoomStatusVersion($roomStatusVersion)
	{
		$this->roomStatusVersion = $roomStatusVersion;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function getVariant()
	{
		return $this->variant;
	}
	
	public function setVariant($variant)
	{
		$this->variant = $variant;
	}
}
