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

class Google_Service_Sheets_BatchUpdateSpreadsheetRequest extends Google_Collection
{
	public $includeSpreadsheetInResponse;
	public $responseIncludeGridData;
	public $responseRanges;
	protected $collection_key = 'responseRanges';
	protected $requestsType = 'Google_Service_Sheets_Request';
	protected $requestsDataType = 'array';
	
	public function getIncludeSpreadsheetInResponse()
	{
		return $this->includeSpreadsheetInResponse;
	}
	
	public function setIncludeSpreadsheetInResponse($includeSpreadsheetInResponse)
	{
		$this->includeSpreadsheetInResponse = $includeSpreadsheetInResponse;
	}
	
	/**
	 * @param Google_Service_Sheets_Request
	 */
	public function setRequests($requests)
	{
		$this->requests = $requests;
	}
	
	/**
	 * @return Google_Service_Sheets_Request
	 */
	public function getRequests()
	{
		return $this->requests;
	}
	
	public function getResponseIncludeGridData()
	{
		return $this->responseIncludeGridData;
	}
	
	public function setResponseIncludeGridData($responseIncludeGridData)
	{
		$this->responseIncludeGridData = $responseIncludeGridData;
	}
	
	public function getResponseRanges()
	{
		return $this->responseRanges;
	}
	
	public function setResponseRanges($responseRanges)
	{
		$this->responseRanges = $responseRanges;
	}
}
