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

class Google_Service_Fitness_DataPoint extends Google_Collection
{
	public $computationTimeMillis;
	public $dataTypeName;
	public $endTimeNanos;
	public $modifiedTimeMillis;
	public $originDataSourceId;
	public $rawTimestampNanos;
	public $startTimeNanos;
	protected $collection_key = 'value';
	protected $valueType = 'Google_Service_Fitness_Value';
	protected $valueDataType = 'array';
	
	public function getComputationTimeMillis()
	{
		return $this->computationTimeMillis;
	}
	
	public function setComputationTimeMillis($computationTimeMillis)
	{
		$this->computationTimeMillis = $computationTimeMillis;
	}
	
	public function getDataTypeName()
	{
		return $this->dataTypeName;
	}
	
	public function setDataTypeName($dataTypeName)
	{
		$this->dataTypeName = $dataTypeName;
	}
	
	public function getEndTimeNanos()
	{
		return $this->endTimeNanos;
	}
	
	public function setEndTimeNanos($endTimeNanos)
	{
		$this->endTimeNanos = $endTimeNanos;
	}
	
	public function getModifiedTimeMillis()
	{
		return $this->modifiedTimeMillis;
	}
	
	public function setModifiedTimeMillis($modifiedTimeMillis)
	{
		$this->modifiedTimeMillis = $modifiedTimeMillis;
	}
	
	public function getOriginDataSourceId()
	{
		return $this->originDataSourceId;
	}
	
	public function setOriginDataSourceId($originDataSourceId)
	{
		$this->originDataSourceId = $originDataSourceId;
	}
	
	public function getRawTimestampNanos()
	{
		return $this->rawTimestampNanos;
	}
	
	public function setRawTimestampNanos($rawTimestampNanos)
	{
		$this->rawTimestampNanos = $rawTimestampNanos;
	}
	
	public function getStartTimeNanos()
	{
		return $this->startTimeNanos;
	}
	
	public function setStartTimeNanos($startTimeNanos)
	{
		$this->startTimeNanos = $startTimeNanos;
	}
	
	/**
	 * @param Google_Service_Fitness_Value
	 */
	public function setValue($value)
	{
		$this->value = $value;
	}
	
	/**
	 * @return Google_Service_Fitness_Value
	 */
	public function getValue()
	{
		return $this->value;
	}
}
