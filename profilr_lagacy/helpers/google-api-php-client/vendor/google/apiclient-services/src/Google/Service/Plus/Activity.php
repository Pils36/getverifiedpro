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

class Google_Service_Plus_Activity extends Google_Model
{
	public $address;
	public $annotation;
	public $crosspostSource;
	public $etag;
	public $geocode;
	public $id;
	public $kind;
	public $placeId;
	public $placeName;
	public $published;
	public $radius;
	public $title;
	public $updated;
	public $url;
	public $verb;
	protected $accessType = 'Google_Service_Plus_Acl';
	protected $accessDataType = '';
	protected $actorType = 'Google_Service_Plus_ActivityActor';
	protected $actorDataType = '';
	protected $locationType = 'Google_Service_Plus_Place';
	protected $locationDataType = '';
	protected $objectType = 'Google_Service_Plus_ActivityObject';
	protected $objectDataType = '';
	protected $providerType = 'Google_Service_Plus_ActivityProvider';
	protected $providerDataType = '';
	
	/**
	 * @param Google_Service_Plus_Acl
	 */
	public function setAccess(Google_Service_Plus_Acl $access)
	{
		$this->access = $access;
	}
	
	/**
	 * @return Google_Service_Plus_Acl
	 */
	public function getAccess()
	{
		return $this->access;
	}
	
	/**
	 * @param Google_Service_Plus_ActivityActor
	 */
	public function setActor(Google_Service_Plus_ActivityActor $actor)
	{
		$this->actor = $actor;
	}
	
	/**
	 * @return Google_Service_Plus_ActivityActor
	 */
	public function getActor()
	{
		return $this->actor;
	}
	
	public function getAddress()
	{
		return $this->address;
	}
	
	public function setAddress($address)
	{
		$this->address = $address;
	}
	
	public function getAnnotation()
	{
		return $this->annotation;
	}
	
	public function setAnnotation($annotation)
	{
		$this->annotation = $annotation;
	}
	
	public function getCrosspostSource()
	{
		return $this->crosspostSource;
	}
	
	public function setCrosspostSource($crosspostSource)
	{
		$this->crosspostSource = $crosspostSource;
	}
	
	public function getEtag()
	{
		return $this->etag;
	}
	
	public function setEtag($etag)
	{
		$this->etag = $etag;
	}
	
	public function getGeocode()
	{
		return $this->geocode;
	}
	
	public function setGeocode($geocode)
	{
		$this->geocode = $geocode;
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
	
	/**
	 * @param Google_Service_Plus_Place
	 */
	public function setLocation(Google_Service_Plus_Place $location)
	{
		$this->location = $location;
	}
	
	/**
	 * @return Google_Service_Plus_Place
	 */
	public function getLocation()
	{
		return $this->location;
	}
	
	/**
	 * @param Google_Service_Plus_ActivityObject
	 */
	public function setObject(Google_Service_Plus_ActivityObject $object)
	{
		$this->object = $object;
	}
	
	/**
	 * @return Google_Service_Plus_ActivityObject
	 */
	public function getObject()
	{
		return $this->object;
	}
	
	public function getPlaceId()
	{
		return $this->placeId;
	}
	
	public function setPlaceId($placeId)
	{
		$this->placeId = $placeId;
	}
	
	public function getPlaceName()
	{
		return $this->placeName;
	}
	
	public function setPlaceName($placeName)
	{
		$this->placeName = $placeName;
	}
	
	/**
	 * @param Google_Service_Plus_ActivityProvider
	 */
	public function setProvider(Google_Service_Plus_ActivityProvider $provider)
	{
		$this->provider = $provider;
	}
	
	/**
	 * @return Google_Service_Plus_ActivityProvider
	 */
	public function getProvider()
	{
		return $this->provider;
	}
	
	public function getPublished()
	{
		return $this->published;
	}
	
	public function setPublished($published)
	{
		$this->published = $published;
	}
	
	public function getRadius()
	{
		return $this->radius;
	}
	
	public function setRadius($radius)
	{
		$this->radius = $radius;
	}
	
	public function getTitle()
	{
		return $this->title;
	}
	
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	public function getUpdated()
	{
		return $this->updated;
	}
	
	public function setUpdated($updated)
	{
		$this->updated = $updated;
	}
	
	public function getUrl()
	{
		return $this->url;
	}
	
	public function setUrl($url)
	{
		$this->url = $url;
	}
	
	public function getVerb()
	{
		return $this->verb;
	}
	
	public function setVerb($verb)
	{
		$this->verb = $verb;
	}
}
