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

class Google_Service_Bigquery_Dataset extends Google_Collection
{
	public $creationTime;
	public $defaultTableExpirationMs;
	public $description;
	public $etag;
	public $friendlyName;
	public $id;
	public $kind;
	public $labels;
	public $lastModifiedTime;
	public $location;
	public $selfLink;
	protected $collection_key = 'access';
	protected $accessType = 'Google_Service_Bigquery_DatasetAccess';
	protected $accessDataType = 'array';
	protected $datasetReferenceType = 'Google_Service_Bigquery_DatasetReference';
	protected $datasetReferenceDataType = '';
	
	/**
	 * @param Google_Service_Bigquery_DatasetAccess
	 */
	public function setAccess($access)
	{
		$this->access = $access;
	}
	
	/**
	 * @return Google_Service_Bigquery_DatasetAccess
	 */
	public function getAccess()
	{
		return $this->access;
	}
	
	public function getCreationTime()
	{
		return $this->creationTime;
	}
	
	public function setCreationTime($creationTime)
	{
		$this->creationTime = $creationTime;
	}
	
	/**
	 * @param Google_Service_Bigquery_DatasetReference
	 */
	public function setDatasetReference(Google_Service_Bigquery_DatasetReference $datasetReference)
	{
		$this->datasetReference = $datasetReference;
	}
	
	/**
	 * @return Google_Service_Bigquery_DatasetReference
	 */
	public function getDatasetReference()
	{
		return $this->datasetReference;
	}
	
	public function getDefaultTableExpirationMs()
	{
		return $this->defaultTableExpirationMs;
	}
	
	public function setDefaultTableExpirationMs($defaultTableExpirationMs)
	{
		$this->defaultTableExpirationMs = $defaultTableExpirationMs;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getEtag()
	{
		return $this->etag;
	}
	
	public function setEtag($etag)
	{
		$this->etag = $etag;
	}
	
	public function getFriendlyName()
	{
		return $this->friendlyName;
	}
	
	public function setFriendlyName($friendlyName)
	{
		$this->friendlyName = $friendlyName;
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
	
	public function getLabels()
	{
		return $this->labels;
	}
	
	public function setLabels($labels)
	{
		$this->labels = $labels;
	}
	
	public function getLastModifiedTime()
	{
		return $this->lastModifiedTime;
	}
	
	public function setLastModifiedTime($lastModifiedTime)
	{
		$this->lastModifiedTime = $lastModifiedTime;
	}
	
	public function getLocation()
	{
		return $this->location;
	}
	
	public function setLocation($location)
	{
		$this->location = $location;
	}
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
	}
}
