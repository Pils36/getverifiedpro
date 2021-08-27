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

class Google_Service_Books_Volumeseriesinfo extends Google_Collection
{
	public $bookDisplayNumber;
	public $kind;
	public $shortSeriesBookTitle;
	protected $collection_key = 'volumeSeries';
	protected $volumeSeriesType = 'Google_Service_Books_VolumeseriesinfoVolumeSeries';
	protected $volumeSeriesDataType = 'array';
	
	public function getBookDisplayNumber()
	{
		return $this->bookDisplayNumber;
	}
	
	public function setBookDisplayNumber($bookDisplayNumber)
	{
		$this->bookDisplayNumber = $bookDisplayNumber;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	public function getShortSeriesBookTitle()
	{
		return $this->shortSeriesBookTitle;
	}
	
	public function setShortSeriesBookTitle($shortSeriesBookTitle)
	{
		$this->shortSeriesBookTitle = $shortSeriesBookTitle;
	}
	
	/**
	 * @param Google_Service_Books_VolumeseriesinfoVolumeSeries
	 */
	public function setVolumeSeries($volumeSeries)
	{
		$this->volumeSeries = $volumeSeries;
	}
	
	/**
	 * @return Google_Service_Books_VolumeseriesinfoVolumeSeries
	 */
	public function getVolumeSeries()
	{
		return $this->volumeSeries;
	}
}
