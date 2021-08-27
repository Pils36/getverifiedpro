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

class Google_Service_Manager_FirewallModule extends Google_Collection
{
	public $description;
	public $network;
	public $sourceRanges;
	public $sourceTags;
	public $targetTags;
	protected $collection_key = 'targetTags';
	protected $allowedType = 'Google_Service_Manager_AllowedRule';
	protected $allowedDataType = 'array';
	
	public function setAllowed($allowed)
	{
		$this->allowed = $allowed;
	}
	
	public function getAllowed()
	{
		return $this->allowed;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getNetwork()
	{
		return $this->network;
	}
	
	public function setNetwork($network)
	{
		$this->network = $network;
	}
	
	public function getSourceRanges()
	{
		return $this->sourceRanges;
	}
	
	public function setSourceRanges($sourceRanges)
	{
		$this->sourceRanges = $sourceRanges;
	}
	
	public function getSourceTags()
	{
		return $this->sourceTags;
	}
	
	public function setSourceTags($sourceTags)
	{
		$this->sourceTags = $sourceTags;
	}
	
	public function getTargetTags()
	{
		return $this->targetTags;
	}
	
	public function setTargetTags($targetTags)
	{
		$this->targetTags = $targetTags;
	}
}
