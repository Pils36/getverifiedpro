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

class Google_Service_Iam_ServiceAccountKey extends Google_Model
{
	public $keyAlgorithm;
	public $name;
	public $privateKeyData;
	public $privateKeyType;
	public $publicKeyData;
	public $validAfterTime;
	public $validBeforeTime;
	
	public function getKeyAlgorithm()
	{
		return $this->keyAlgorithm;
	}
	
	public function setKeyAlgorithm($keyAlgorithm)
	{
		$this->keyAlgorithm = $keyAlgorithm;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getPrivateKeyData()
	{
		return $this->privateKeyData;
	}
	
	public function setPrivateKeyData($privateKeyData)
	{
		$this->privateKeyData = $privateKeyData;
	}
	
	public function getPrivateKeyType()
	{
		return $this->privateKeyType;
	}
	
	public function setPrivateKeyType($privateKeyType)
	{
		$this->privateKeyType = $privateKeyType;
	}
	
	public function getPublicKeyData()
	{
		return $this->publicKeyData;
	}
	
	public function setPublicKeyData($publicKeyData)
	{
		$this->publicKeyData = $publicKeyData;
	}
	
	public function getValidAfterTime()
	{
		return $this->validAfterTime;
	}
	
	public function setValidAfterTime($validAfterTime)
	{
		$this->validAfterTime = $validAfterTime;
	}
	
	public function getValidBeforeTime()
	{
		return $this->validBeforeTime;
	}
	
	public function setValidBeforeTime($validBeforeTime)
	{
		$this->validBeforeTime = $validBeforeTime;
	}
}
