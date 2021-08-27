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

class Google_Service_Games_Instance extends Google_Model
{
	public $acquisitionUri;
	public $kind;
	public $name;
	public $platformType;
	public $realtimePlay;
	public $turnBasedPlay;
	protected $androidInstanceType = 'Google_Service_Games_InstanceAndroidDetails';
	protected $androidInstanceDataType = '';
	protected $iosInstanceType = 'Google_Service_Games_InstanceIosDetails';
	protected $iosInstanceDataType = '';
	protected $webInstanceType = 'Google_Service_Games_InstanceWebDetails';
	protected $webInstanceDataType = '';
	
	public function getAcquisitionUri()
	{
		return $this->acquisitionUri;
	}
	
	public function setAcquisitionUri($acquisitionUri)
	{
		$this->acquisitionUri = $acquisitionUri;
	}
	
	/**
	 * @param Google_Service_Games_InstanceAndroidDetails
	 */
	public function setAndroidInstance(Google_Service_Games_InstanceAndroidDetails $androidInstance)
	{
		$this->androidInstance = $androidInstance;
	}
	
	/**
	 * @return Google_Service_Games_InstanceAndroidDetails
	 */
	public function getAndroidInstance()
	{
		return $this->androidInstance;
	}
	
	/**
	 * @param Google_Service_Games_InstanceIosDetails
	 */
	public function setIosInstance(Google_Service_Games_InstanceIosDetails $iosInstance)
	{
		$this->iosInstance = $iosInstance;
	}
	
	/**
	 * @return Google_Service_Games_InstanceIosDetails
	 */
	public function getIosInstance()
	{
		return $this->iosInstance;
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
	
	public function getPlatformType()
	{
		return $this->platformType;
	}
	
	public function setPlatformType($platformType)
	{
		$this->platformType = $platformType;
	}
	
	public function getRealtimePlay()
	{
		return $this->realtimePlay;
	}
	
	public function setRealtimePlay($realtimePlay)
	{
		$this->realtimePlay = $realtimePlay;
	}
	
	public function getTurnBasedPlay()
	{
		return $this->turnBasedPlay;
	}
	
	public function setTurnBasedPlay($turnBasedPlay)
	{
		$this->turnBasedPlay = $turnBasedPlay;
	}
	
	/**
	 * @param Google_Service_Games_InstanceWebDetails
	 */
	public function setWebInstance(Google_Service_Games_InstanceWebDetails $webInstance)
	{
		$this->webInstance = $webInstance;
	}
	
	/**
	 * @return Google_Service_Games_InstanceWebDetails
	 */
	public function getWebInstance()
	{
		return $this->webInstance;
	}
}
