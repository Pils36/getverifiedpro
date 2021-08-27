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

class Google_Service_Games_EventUpdateResponse extends Google_Collection
{
	public $kind;
	protected $collection_key = 'playerEvents';
	protected $batchFailuresType = 'Google_Service_Games_EventBatchRecordFailure';
	protected $batchFailuresDataType = 'array';
	protected $eventFailuresType = 'Google_Service_Games_EventRecordFailure';
	protected $eventFailuresDataType = 'array';
	protected $playerEventsType = 'Google_Service_Games_PlayerEvent';
	protected $playerEventsDataType = 'array';
	
	/**
	 * @param Google_Service_Games_EventBatchRecordFailure
	 */
	public function setBatchFailures($batchFailures)
	{
		$this->batchFailures = $batchFailures;
	}
	
	/**
	 * @return Google_Service_Games_EventBatchRecordFailure
	 */
	public function getBatchFailures()
	{
		return $this->batchFailures;
	}
	
	/**
	 * @param Google_Service_Games_EventRecordFailure
	 */
	public function setEventFailures($eventFailures)
	{
		$this->eventFailures = $eventFailures;
	}
	
	/**
	 * @return Google_Service_Games_EventRecordFailure
	 */
	public function getEventFailures()
	{
		return $this->eventFailures;
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
	 * @param Google_Service_Games_PlayerEvent
	 */
	public function setPlayerEvents($playerEvents)
	{
		$this->playerEvents = $playerEvents;
	}
	
	/**
	 * @return Google_Service_Games_PlayerEvent
	 */
	public function getPlayerEvents()
	{
		return $this->playerEvents;
	}
}