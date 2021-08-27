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

class Google_Service_Surveys_SurveyAudience extends Google_Collection
{
	public $ages;
	public $country;
	public $countrySubdivision;
	public $gender;
	public $languages;
	public $mobileAppPanelId;
	public $populationSource;
	protected $collection_key = 'languages';
	
	public function getAges()
	{
		return $this->ages;
	}
	
	public function setAges($ages)
	{
		$this->ages = $ages;
	}
	
	public function getCountry()
	{
		return $this->country;
	}
	
	public function setCountry($country)
	{
		$this->country = $country;
	}
	
	public function getCountrySubdivision()
	{
		return $this->countrySubdivision;
	}
	
	public function setCountrySubdivision($countrySubdivision)
	{
		$this->countrySubdivision = $countrySubdivision;
	}
	
	public function getGender()
	{
		return $this->gender;
	}
	
	public function setGender($gender)
	{
		$this->gender = $gender;
	}
	
	public function getLanguages()
	{
		return $this->languages;
	}
	
	public function setLanguages($languages)
	{
		$this->languages = $languages;
	}
	
	public function getMobileAppPanelId()
	{
		return $this->mobileAppPanelId;
	}
	
	public function setMobileAppPanelId($mobileAppPanelId)
	{
		$this->mobileAppPanelId = $mobileAppPanelId;
	}
	
	public function getPopulationSource()
	{
		return $this->populationSource;
	}
	
	public function setPopulationSource($populationSource)
	{
		$this->populationSource = $populationSource;
	}
}
