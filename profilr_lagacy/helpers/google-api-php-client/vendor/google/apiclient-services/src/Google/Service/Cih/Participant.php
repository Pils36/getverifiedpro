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

class Google_Service_Cih_Participant extends Google_Model
{
	public $contactId;
	public $email;
	public $familyName;
	public $gaiaId;
	public $givenName;
	public $name;
	
	public function getContactId()
	{
		return $this->contactId;
	}
	
	public function setContactId($contactId)
	{
		$this->contactId = $contactId;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	public function getFamilyName()
	{
		return $this->familyName;
	}
	
	public function setFamilyName($familyName)
	{
		$this->familyName = $familyName;
	}
	
	public function getGaiaId()
	{
		return $this->gaiaId;
	}
	
	public function setGaiaId($gaiaId)
	{
		$this->gaiaId = $gaiaId;
	}
	
	public function getGivenName()
	{
		return $this->givenName;
	}
	
	public function setGivenName($givenName)
	{
		$this->givenName = $givenName;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
}
