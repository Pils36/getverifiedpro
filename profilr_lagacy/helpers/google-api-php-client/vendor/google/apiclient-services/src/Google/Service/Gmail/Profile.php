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

class Google_Service_Gmail_Profile extends Google_Model
{
	public $emailAddress;
	public $historyId;
	public $messagesTotal;
	public $threadsTotal;
	
	public function getEmailAddress()
	{
		return $this->emailAddress;
	}
	
	public function setEmailAddress($emailAddress)
	{
		$this->emailAddress = $emailAddress;
	}
	
	public function getHistoryId()
	{
		return $this->historyId;
	}
	
	public function setHistoryId($historyId)
	{
		$this->historyId = $historyId;
	}
	
	public function getMessagesTotal()
	{
		return $this->messagesTotal;
	}
	
	public function setMessagesTotal($messagesTotal)
	{
		$this->messagesTotal = $messagesTotal;
	}
	
	public function getThreadsTotal()
	{
		return $this->threadsTotal;
	}
	
	public function setThreadsTotal($threadsTotal)
	{
		$this->threadsTotal = $threadsTotal;
	}
}
