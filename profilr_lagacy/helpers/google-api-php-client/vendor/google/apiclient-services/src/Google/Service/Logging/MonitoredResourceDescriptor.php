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

class Google_Service_Logging_MonitoredResourceDescriptor extends Google_Collection
{
	public $description;
	public $displayName;
	public $name;
	public $type;
	protected $collection_key = 'labels';
	protected $labelsType = 'Google_Service_Logging_LabelDescriptor';
	protected $labelsDataType = 'array';
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getDisplayName()
	{
		return $this->displayName;
	}
	
	public function setDisplayName($displayName)
	{
		$this->displayName = $displayName;
	}
	
	/**
	 * @param Google_Service_Logging_LabelDescriptor
	 */
	public function setLabels($labels)
	{
		$this->labels = $labels;
	}
	
	/**
	 * @return Google_Service_Logging_LabelDescriptor
	 */
	public function getLabels()
	{
		return $this->labels;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
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
