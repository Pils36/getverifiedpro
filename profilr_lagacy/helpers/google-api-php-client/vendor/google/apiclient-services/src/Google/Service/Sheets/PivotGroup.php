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

class Google_Service_Sheets_PivotGroup extends Google_Collection
{
	public $showTotals;
	public $sortOrder;
	public $sourceColumnOffset;
	protected $collection_key = 'valueMetadata';
	protected $valueBucketType = 'Google_Service_Sheets_PivotGroupSortValueBucket';
	protected $valueBucketDataType = '';
	protected $valueMetadataType = 'Google_Service_Sheets_PivotGroupValueMetadata';
	protected $valueMetadataDataType = 'array';
	
	public function getShowTotals()
	{
		return $this->showTotals;
	}
	
	public function setShowTotals($showTotals)
	{
		$this->showTotals = $showTotals;
	}
	
	public function getSortOrder()
	{
		return $this->sortOrder;
	}
	
	public function setSortOrder($sortOrder)
	{
		$this->sortOrder = $sortOrder;
	}
	
	public function getSourceColumnOffset()
	{
		return $this->sourceColumnOffset;
	}
	
	public function setSourceColumnOffset($sourceColumnOffset)
	{
		$this->sourceColumnOffset = $sourceColumnOffset;
	}
	
	/**
	 * @param Google_Service_Sheets_PivotGroupSortValueBucket
	 */
	public function setValueBucket(Google_Service_Sheets_PivotGroupSortValueBucket $valueBucket)
	{
		$this->valueBucket = $valueBucket;
	}
	
	/**
	 * @return Google_Service_Sheets_PivotGroupSortValueBucket
	 */
	public function getValueBucket()
	{
		return $this->valueBucket;
	}
	
	/**
	 * @param Google_Service_Sheets_PivotGroupValueMetadata
	 */
	public function setValueMetadata($valueMetadata)
	{
		$this->valueMetadata = $valueMetadata;
	}
	
	/**
	 * @return Google_Service_Sheets_PivotGroupValueMetadata
	 */
	public function getValueMetadata()
	{
		return $this->valueMetadata;
	}
}
