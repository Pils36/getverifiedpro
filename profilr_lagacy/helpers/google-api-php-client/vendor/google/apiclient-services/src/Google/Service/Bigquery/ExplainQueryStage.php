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

class Google_Service_Bigquery_ExplainQueryStage extends Google_Collection
{
	public $computeRatioAvg;
	public $computeRatioMax;
	public $id;
	public $name;
	public $readRatioAvg;
	public $readRatioMax;
	public $recordsRead;
	public $recordsWritten;
	public $status;
	public $waitRatioAvg;
	public $waitRatioMax;
	public $writeRatioAvg;
	public $writeRatioMax;
	protected $collection_key = 'steps';
	protected $stepsType = 'Google_Service_Bigquery_ExplainQueryStep';
	protected $stepsDataType = 'array';
	
	public function getComputeRatioAvg()
	{
		return $this->computeRatioAvg;
	}
	
	public function setComputeRatioAvg($computeRatioAvg)
	{
		$this->computeRatioAvg = $computeRatioAvg;
	}
	
	public function getComputeRatioMax()
	{
		return $this->computeRatioMax;
	}
	
	public function setComputeRatioMax($computeRatioMax)
	{
		$this->computeRatioMax = $computeRatioMax;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getReadRatioAvg()
	{
		return $this->readRatioAvg;
	}
	
	public function setReadRatioAvg($readRatioAvg)
	{
		$this->readRatioAvg = $readRatioAvg;
	}
	
	public function getReadRatioMax()
	{
		return $this->readRatioMax;
	}
	
	public function setReadRatioMax($readRatioMax)
	{
		$this->readRatioMax = $readRatioMax;
	}
	
	public function getRecordsRead()
	{
		return $this->recordsRead;
	}
	
	public function setRecordsRead($recordsRead)
	{
		$this->recordsRead = $recordsRead;
	}
	
	public function getRecordsWritten()
	{
		return $this->recordsWritten;
	}
	
	public function setRecordsWritten($recordsWritten)
	{
		$this->recordsWritten = $recordsWritten;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	/**
	 * @param Google_Service_Bigquery_ExplainQueryStep
	 */
	public function setSteps($steps)
	{
		$this->steps = $steps;
	}
	
	/**
	 * @return Google_Service_Bigquery_ExplainQueryStep
	 */
	public function getSteps()
	{
		return $this->steps;
	}
	
	public function getWaitRatioAvg()
	{
		return $this->waitRatioAvg;
	}
	
	public function setWaitRatioAvg($waitRatioAvg)
	{
		$this->waitRatioAvg = $waitRatioAvg;
	}
	
	public function getWaitRatioMax()
	{
		return $this->waitRatioMax;
	}
	
	public function setWaitRatioMax($waitRatioMax)
	{
		$this->waitRatioMax = $waitRatioMax;
	}
	
	public function getWriteRatioAvg()
	{
		return $this->writeRatioAvg;
	}
	
	public function setWriteRatioAvg($writeRatioAvg)
	{
		$this->writeRatioAvg = $writeRatioAvg;
	}
	
	public function getWriteRatioMax()
	{
		return $this->writeRatioMax;
	}
	
	public function setWriteRatioMax($writeRatioMax)
	{
		$this->writeRatioMax = $writeRatioMax;
	}
}
