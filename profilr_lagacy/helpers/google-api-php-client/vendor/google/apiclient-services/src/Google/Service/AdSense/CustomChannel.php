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

class Google_Service_AdSense_CustomChannel extends Google_Model
{
	public $code;
	public $id;
	public $kind;
	public $name;
	protected $targetingInfoType = 'Google_Service_AdSense_CustomChannelTargetingInfo';
	protected $targetingInfoDataType = '';
	
	public function getCode()
	{
		return $this->code;
	}
	
	public function setCode($code)
	{
		$this->code = $code;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	/**
	 * @param Google_Service_AdSense_CustomChannelTargetingInfo
	 */
	public function setTargetingInfo(Google_Service_AdSense_CustomChannelTargetingInfo $targetingInfo)
	{
		$this->targetingInfo = $targetingInfo;
	}
	
	/**
	 * @return Google_Service_AdSense_CustomChannelTargetingInfo
	 */
	public function getTargetingInfo()
	{
		return $this->targetingInfo;
	}
}
