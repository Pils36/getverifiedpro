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

class Google_Service_Games_TurnBasedMatch extends Google_Collection
{
	public $applicationId;
	public $description;
	public $inviterId;
	public $kind;
	public $matchId;
	public $matchNumber;
	public $matchVersion;
	public $pendingParticipantId;
	public $rematchId;
	public $status;
	public $userMatchStatus;
	public $variant;
	public $withParticipantId;
	protected $collection_key = 'results';
	protected $autoMatchingCriteriaType = 'Google_Service_Games_TurnBasedAutoMatchingCriteria';
	protected $autoMatchingCriteriaDataType = '';
	protected $creationDetailsType = 'Google_Service_Games_TurnBasedMatchModification';
	protected $creationDetailsDataType = '';
	protected $dataType = 'Google_Service_Games_TurnBasedMatchData';
	protected $dataDataType = '';
	protected $lastUpdateDetailsType = 'Google_Service_Games_TurnBasedMatchModification';
	protected $lastUpdateDetailsDataType = '';
	protected $participantsType = 'Google_Service_Games_TurnBasedMatchParticipant';
	protected $participantsDataType = 'array';
	protected $previousMatchDataType = 'Google_Service_Games_TurnBasedMatchData';
	protected $previousMatchDataDataType = '';
	protected $resultsType = 'Google_Service_Games_ParticipantResult';
	protected $resultsDataType = 'array';
	
	public function getApplicationId()
	{
		return $this->applicationId;
	}
	
	public function setApplicationId($applicationId)
	{
		$this->applicationId = $applicationId;
	}
	
	/**
	 * @param Google_Service_Games_TurnBasedAutoMatchingCriteria
	 */
	public function setAutoMatchingCriteria(Google_Service_Games_TurnBasedAutoMatchingCriteria $autoMatchingCriteria)
	{
		$this->autoMatchingCriteria = $autoMatchingCriteria;
	}
	
	/**
	 * @return Google_Service_Games_TurnBasedAutoMatchingCriteria
	 */
	public function getAutoMatchingCriteria()
	{
		return $this->autoMatchingCriteria;
	}
	
	/**
	 * @param Google_Service_Games_TurnBasedMatchModification
	 */
	public function setCreationDetails(Google_Service_Games_TurnBasedMatchModification $creationDetails)
	{
		$this->creationDetails = $creationDetails;
	}
	
	/**
	 * @return Google_Service_Games_TurnBasedMatchModification
	 */
	public function getCreationDetails()
	{
		return $this->creationDetails;
	}
	
	/**
	 * @param Google_Service_Games_TurnBasedMatchData
	 */
	public function setData(Google_Service_Games_TurnBasedMatchData $data)
	{
		$this->data = $data;
	}
	
	/**
	 * @return Google_Service_Games_TurnBasedMatchData
	 */
	public function getData()
	{
		return $this->data;
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
	 * @param Google_Service_Games_TurnBasedMatchModification
	 */
	public function setLastUpdateDetails(Google_Service_Games_TurnBasedMatchModification $lastUpdateDetails)
	{
		$this->lastUpdateDetails = $lastUpdateDetails;
	}
	
	/**
	 * @return Google_Service_Games_TurnBasedMatchModification
	 */
	public function getLastUpdateDetails()
	{
		return $this->lastUpdateDetails;
	}
	
	public function getMatchId()
	{
		return $this->matchId;
	}
	
	public function setMatchId($matchId)
	{
		$this->matchId = $matchId;
	}
	
	public function getMatchNumber()
	{
		return $this->matchNumber;
	}
	
	public function setMatchNumber($matchNumber)
	{
		$this->matchNumber = $matchNumber;
	}
	
	public function getMatchVersion()
	{
		return $this->matchVersion;
	}
	
	public function setMatchVersion($matchVersion)
	{
		$this->matchVersion = $matchVersion;
	}
	
	/**
	 * @param Google_Service_Games_TurnBasedMatchParticipant
	 */
	public function setParticipants($participants)
	{
		$this->participants = $participants;
	}
	
	/**
	 * @return Google_Service_Games_TurnBasedMatchParticipant
	 */
	public function getParticipants()
	{
		return $this->participants;
	}
	
	public function getPendingParticipantId()
	{
		return $this->pendingParticipantId;
	}
	
	public function setPendingParticipantId($pendingParticipantId)
	{
		$this->pendingParticipantId = $pendingParticipantId;
	}
	
	/**
	 * @param Google_Service_Games_TurnBasedMatchData
	 */
	public function setPreviousMatchData(Google_Service_Games_TurnBasedMatchData $previousMatchData)
	{
		$this->previousMatchData = $previousMatchData;
	}
	
	/**
	 * @return Google_Service_Games_TurnBasedMatchData
	 */
	public function getPreviousMatchData()
	{
		return $this->previousMatchData;
	}
	
	public function getRematchId()
	{
		return $this->rematchId;
	}
	
	public function setRematchId($rematchId)
	{
		$this->rematchId = $rematchId;
	}
	
	/**
	 * @param Google_Service_Games_ParticipantResult
	 */
	public function setResults($results)
	{
		$this->results = $results;
	}
	
	/**
	 * @return Google_Service_Games_ParticipantResult
	 */
	public function getResults()
	{
		return $this->results;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function getUserMatchStatus()
	{
		return $this->userMatchStatus;
	}
	
	public function setUserMatchStatus($userMatchStatus)
	{
		$this->userMatchStatus = $userMatchStatus;
	}
	
	public function getVariant()
	{
		return $this->variant;
	}
	
	public function setVariant($variant)
	{
		$this->variant = $variant;
	}
	
	public function getWithParticipantId()
	{
		return $this->withParticipantId;
	}
	
	public function setWithParticipantId($withParticipantId)
	{
		$this->withParticipantId = $withParticipantId;
	}
}
