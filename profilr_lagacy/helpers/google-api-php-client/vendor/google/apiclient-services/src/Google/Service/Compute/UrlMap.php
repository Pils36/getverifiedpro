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

class Google_Service_Compute_UrlMap extends Google_Collection
{
	public $creationTimestamp;
	public $defaultService;
	public $description;
	public $fingerprint;
	public $id;
	public $kind;
	public $name;
	public $selfLink;
	protected $collection_key = 'tests';
	protected $hostRulesType = 'Google_Service_Compute_HostRule';
	protected $hostRulesDataType = 'array';
	protected $pathMatchersType = 'Google_Service_Compute_PathMatcher';
	protected $pathMatchersDataType = 'array';
	protected $testsType = 'Google_Service_Compute_UrlMapTest';
	protected $testsDataType = 'array';
	
	public function getCreationTimestamp()
	{
		return $this->creationTimestamp;
	}
	
	public function setCreationTimestamp($creationTimestamp)
	{
		$this->creationTimestamp = $creationTimestamp;
	}
	
	public function getDefaultService()
	{
		return $this->defaultService;
	}
	
	public function setDefaultService($defaultService)
	{
		$this->defaultService = $defaultService;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getFingerprint()
	{
		return $this->fingerprint;
	}
	
	public function setFingerprint($fingerprint)
	{
		$this->fingerprint = $fingerprint;
	}
	
	/**
	 * @param Google_Service_Compute_HostRule
	 */
	public function setHostRules($hostRules)
	{
		$this->hostRules = $hostRules;
	}
	
	/**
	 * @return Google_Service_Compute_HostRule
	 */
	public function getHostRules()
	{
		return $this->hostRules;
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
	 * @param Google_Service_Compute_PathMatcher
	 */
	public function setPathMatchers($pathMatchers)
	{
		$this->pathMatchers = $pathMatchers;
	}
	
	/**
	 * @return Google_Service_Compute_PathMatcher
	 */
	public function getPathMatchers()
	{
		return $this->pathMatchers;
	}
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
	}
	
	/**
	 * @param Google_Service_Compute_UrlMapTest
	 */
	public function setTests($tests)
	{
		$this->tests = $tests;
	}
	
	/**
	 * @return Google_Service_Compute_UrlMapTest
	 */
	public function getTests()
	{
		return $this->tests;
	}
}
