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

class Google_Service_Storage_Notification extends Google_Collection
{
	public $customAttributes;
	public $etag;
	public $eventTypes;
	public $id;
	public $kind;
	public $objectNamePrefix;
	public $payloadFormat;
	public $selfLink;
	public $topic;
	protected $collection_key = 'event_types';
	protected $internal_gapi_mappings = array(
		"customAttributes" => "custom_attributes",
		"eventTypes" => "event_types",
		"objectNamePrefix" => "object_name_prefix",
		"payloadFormat" => "payload_format",
	);
	
	public function getCustomAttributes()
	{
		return $this->customAttributes;
	}
	
	public function setCustomAttributes($customAttributes)
	{
		$this->customAttributes = $customAttributes;
	}
	
	public function getEtag()
	{
		return $this->etag;
	}
	
	public function setEtag($etag)
	{
		$this->etag = $etag;
	}
	
	public function getEventTypes()
	{
		return $this->eventTypes;
	}
	
	public function setEventTypes($eventTypes)
	{
		$this->eventTypes = $eventTypes;
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
	
	public function getObjectNamePrefix()
	{
		return $this->objectNamePrefix;
	}
	
	public function setObjectNamePrefix($objectNamePrefix)
	{
		$this->objectNamePrefix = $objectNamePrefix;
	}
	
	public function getPayloadFormat()
	{
		return $this->payloadFormat;
	}
	
	public function setPayloadFormat($payloadFormat)
	{
		$this->payloadFormat = $payloadFormat;
	}
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
	}
	
	public function getTopic()
	{
		return $this->topic;
	}
	
	public function setTopic($topic)
	{
		$this->topic = $topic;
	}
}
