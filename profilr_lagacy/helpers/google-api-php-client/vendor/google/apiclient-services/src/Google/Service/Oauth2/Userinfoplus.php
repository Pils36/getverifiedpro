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

class Google_Service_Oauth2_Userinfoplus extends Google_Model
{
	public $email;
	public $familyName;
	public $gender;
	public $givenName;
	public $hd;
	public $id;
	public $link;
	public $locale;
	public $name;
	public $picture;
	public $verifiedEmail;
	protected $internal_gapi_mappings = array(
		"familyName" => "family_name",
		"givenName" => "given_name",
		"verifiedEmail" => "verified_email",
	);
	
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
	
	public function getGender()
	{
		return $this->gender;
	}
	
	public function setGender($gender)
	{
		$this->gender = $gender;
	}
	
	public function getGivenName()
	{
		return $this->givenName;
	}
	
	public function setGivenName($givenName)
	{
		$this->givenName = $givenName;
	}
	
	public function getHd()
	{
		return $this->hd;
	}
	
	public function setHd($hd)
	{
		$this->hd = $hd;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getLink()
	{
		return $this->link;
	}
	
	public function setLink($link)
	{
		$this->link = $link;
	}
	
	public function getLocale()
	{
		return $this->locale;
	}
	
	public function setLocale($locale)
	{
		$this->locale = $locale;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getPicture()
	{
		return $this->picture;
	}
	
	public function setPicture($picture)
	{
		$this->picture = $picture;
	}
	
	public function getVerifiedEmail()
	{
		return $this->verifiedEmail;
	}
	
	public function setVerifiedEmail($verifiedEmail)
	{
		$this->verifiedEmail = $verifiedEmail;
	}
}
