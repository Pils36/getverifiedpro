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

class Google_Service_Fitness_AggregateBucket extends Google_Collection
{
	public $activity;
	public $endTimeMillis;
	public $startTimeMillis;
	public $type;
	protected $collection_key = 'dataset';
	protected $datasetType = 'Google_Service_Fitness_Dataset';
	protected $datasetDataType = 'array';
	protected $sessionType = 'Google_Service_Fitness_Session';
	protected $sessionDataType = '';
	
	public function getActivity()
	{
		return $this->activity;
	}
	
	public function setActivity($activity)
	{
		$this->activity = $activity;
	}
	
	/**
	 * @param Google_Service_Fitness_Dataset
	 */
	public function setDataset($dataset)
	{
		$this->dataset = $dataset;
	}
	
	/**
	 * @return Google_Service_Fitness_Dataset
	 */
	public function getDataset()
	{
		return $this->dataset;
	}
	
	public function getEndTimeMillis()
	{
		return $this->endTimeMillis;
	}
	
	public function setEndTimeMillis($endTimeMillis)
	{
		$this->endTimeMillis = $endTimeMillis;
	}
	
	/**
	 * @param Google_Service_Fitness_Session
	 */
	public function setSession(Google_Service_Fitness_Session $session)
	{
		$this->session = $session;
	}
	
	/**
	 * @return Google_Service_Fitness_Session
	 */
	public function getSession()
	{
		return $this->session;
	}
	
	public function getStartTimeMillis()
	{
		return $this->startTimeMillis;
	}
	
	public function setStartTimeMillis($startTimeMillis)
	{
		$this->startTimeMillis = $startTimeMillis;
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function setType($type)
	{
		$this->type = $type;
	}
}
