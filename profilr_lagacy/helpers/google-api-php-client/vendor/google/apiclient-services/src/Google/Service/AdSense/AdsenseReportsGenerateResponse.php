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

class Google_Service_AdSense_AdsenseReportsGenerateResponse extends Google_Collection
{
	public $averages;
	public $endDate;
	public $kind;
	public $rows;
	public $startDate;
	public $totalMatchedRows;
	public $totals;
	public $warnings;
	protected $collection_key = 'warnings';
	protected $headersType = 'Google_Service_AdSense_AdsenseReportsGenerateResponseHeaders';
	protected $headersDataType = 'array';
	
	public function getAverages()
	{
		return $this->averages;
	}
	
	public function setAverages($averages)
	{
		$this->averages = $averages;
	}
	
	public function getEndDate()
	{
		return $this->endDate;
	}
	
	public function setEndDate($endDate)
	{
		$this->endDate = $endDate;
	}
	
	/**
	 * @param Google_Service_AdSense_AdsenseReportsGenerateResponseHeaders
	 */
	public function setHeaders($headers)
	{
		$this->headers = $headers;
	}
	
	/**
	 * @return Google_Service_AdSense_AdsenseReportsGenerateResponseHeaders
	 */
	public function getHeaders()
	{
		return $this->headers;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	public function getRows()
	{
		return $this->rows;
	}
	
	public function setRows($rows)
	{
		$this->rows = $rows;
	}
	
	public function getStartDate()
	{
		return $this->startDate;
	}
	
	public function setStartDate($startDate)
	{
		$this->startDate = $startDate;
	}
	
	public function getTotalMatchedRows()
	{
		return $this->totalMatchedRows;
	}
	
	public function setTotalMatchedRows($totalMatchedRows)
	{
		$this->totalMatchedRows = $totalMatchedRows;
	}
	
	public function getTotals()
	{
		return $this->totals;
	}
	
	public function setTotals($totals)
	{
		$this->totals = $totals;
	}
	
	public function getWarnings()
	{
		return $this->warnings;
	}
	
	public function setWarnings($warnings)
	{
		$this->warnings = $warnings;
	}
}
