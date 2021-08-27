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

class Google_Service_People_Name extends Google_Model
{
	public $displayName;
	public $displayNameLastFirst;
	public $familyName;
	public $givenName;
	public $honorificPrefix;
	public $honorificSuffix;
	public $middleName;
	public $phoneticFamilyName;
	public $phoneticFullName;
	public $phoneticGivenName;
	public $phoneticHonorificPrefix;
	public $phoneticHonorificSuffix;
	public $phoneticMiddleName;
	protected $metadataType = 'Google_Service_People_FieldMetadata';
	protected $metadataDataType = '';
	
	public function getDisplayName()
	{
		return $this->displayName;
	}
	
	public function setDisplayName($displayName)
	{
		$this->displayName = $displayName;
	}
	
	public function getDisplayNameLastFirst()
	{
		return $this->displayNameLastFirst;
	}
	
	public function setDisplayNameLastFirst($displayNameLastFirst)
	{
		$this->displayNameLastFirst = $displayNameLastFirst;
	}
	
	public function getFamilyName()
	{
		return $this->familyName;
	}
	
	public function setFamilyName($familyName)
	{
		$this->familyName = $familyName;
	}
	
	public function getGivenName()
	{
		return $this->givenName;
	}
	
	public function setGivenName($givenName)
	{
		$this->givenName = $givenName;
	}
	
	public function getHonorificPrefix()
	{
		return $this->honorificPrefix;
	}
	
	public function setHonorificPrefix($honorificPrefix)
	{
		$this->honorificPrefix = $honorificPrefix;
	}
	
	public function getHonorificSuffix()
	{
		return $this->honorificSuffix;
	}
	
	public function setHonorificSuffix($honorificSuffix)
	{
		$this->honorificSuffix = $honorificSuffix;
	}
	
	public function setMetadata(Google_Service_People_FieldMetadata $metadata)
	{
		$this->metadata = $metadata;
	}
	
	public function getMetadata()
	{
		return $this->metadata;
	}
	
	public function getMiddleName()
	{
		return $this->middleName;
	}
	
	public function setMiddleName($middleName)
	{
		$this->middleName = $middleName;
	}
	
	public function getPhoneticFamilyName()
	{
		return $this->phoneticFamilyName;
	}
	
	public function setPhoneticFamilyName($phoneticFamilyName)
	{
		$this->phoneticFamilyName = $phoneticFamilyName;
	}
	
	public function getPhoneticFullName()
	{
		return $this->phoneticFullName;
	}
	
	public function setPhoneticFullName($phoneticFullName)
	{
		$this->phoneticFullName = $phoneticFullName;
	}
	
	public function getPhoneticGivenName()
	{
		return $this->phoneticGivenName;
	}
	
	public function setPhoneticGivenName($phoneticGivenName)
	{
		$this->phoneticGivenName = $phoneticGivenName;
	}
	
	public function getPhoneticHonorificPrefix()
	{
		return $this->phoneticHonorificPrefix;
	}
	
	public function setPhoneticHonorificPrefix($phoneticHonorificPrefix)
	{
		$this->phoneticHonorificPrefix = $phoneticHonorificPrefix;
	}
	
	public function getPhoneticHonorificSuffix()
	{
		return $this->phoneticHonorificSuffix;
	}
	
	public function setPhoneticHonorificSuffix($phoneticHonorificSuffix)
	{
		$this->phoneticHonorificSuffix = $phoneticHonorificSuffix;
	}
	
	public function getPhoneticMiddleName()
	{
		return $this->phoneticMiddleName;
	}
	
	public function setPhoneticMiddleName($phoneticMiddleName)
	{
		$this->phoneticMiddleName = $phoneticMiddleName;
	}
}
