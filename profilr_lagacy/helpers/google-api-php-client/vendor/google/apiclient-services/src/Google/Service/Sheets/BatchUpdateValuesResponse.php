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

class Google_Service_Sheets_BatchUpdateValuesResponse extends Google_Collection
{
	public $spreadsheetId;
	public $totalUpdatedCells;
	public $totalUpdatedColumns;
	public $totalUpdatedRows;
	public $totalUpdatedSheets;
	protected $collection_key = 'responses';
	protected $responsesType = 'Google_Service_Sheets_UpdateValuesResponse';
	protected $responsesDataType = 'array';
	
	/**
	 * @param Google_Service_Sheets_UpdateValuesResponse
	 */
	public function setResponses($responses)
	{
		$this->responses = $responses;
	}
	
	/**
	 * @return Google_Service_Sheets_UpdateValuesResponse
	 */
	public function getResponses()
	{
		return $this->responses;
	}
	
	public function getSpreadsheetId()
	{
		return $this->spreadsheetId;
	}
	
	public function setSpreadsheetId($spreadsheetId)
	{
		$this->spreadsheetId = $spreadsheetId;
	}
	
	public function getTotalUpdatedCells()
	{
		return $this->totalUpdatedCells;
	}
	
	public function setTotalUpdatedCells($totalUpdatedCells)
	{
		$this->totalUpdatedCells = $totalUpdatedCells;
	}
	
	public function getTotalUpdatedColumns()
	{
		return $this->totalUpdatedColumns;
	}
	
	public function setTotalUpdatedColumns($totalUpdatedColumns)
	{
		$this->totalUpdatedColumns = $totalUpdatedColumns;
	}
	
	public function getTotalUpdatedRows()
	{
		return $this->totalUpdatedRows;
	}
	
	public function setTotalUpdatedRows($totalUpdatedRows)
	{
		$this->totalUpdatedRows = $totalUpdatedRows;
	}
	
	public function getTotalUpdatedSheets()
	{
		return $this->totalUpdatedSheets;
	}
	
	public function setTotalUpdatedSheets($totalUpdatedSheets)
	{
		$this->totalUpdatedSheets = $totalUpdatedSheets;
	}
}
