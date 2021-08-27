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

class Google_Service_Games_RoomStatus extends Google_Collection
{
	public $kind;
	public $roomId;
	public $status;
	public $statusVersion;
	protected $collection_key = 'participants';
	protected $autoMatchingStatusType = 'Google_Service_Games_RoomAutoMatchStatus';
	protected $autoMatchingStatusDataType = '';
	protected $participantsType = 'Google_Service_Games_RoomParticipant';
	protected $participantsDataType = 'array';
	
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
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
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
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function getStatusVersion()
	{
		return $this->statusVersion;
	}
	
	public function setStatusVersion($statusVersion)
	{
		$this->statusVersion = $statusVersion;
	}
}
