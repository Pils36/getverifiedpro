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

class Google_Service_Slides_CreateShapeRequest extends Google_Model
{
	public $objectId;
	public $shapeType;
	protected $elementPropertiesType = 'Google_Service_Slides_PageElementProperties';
	protected $elementPropertiesDataType = '';
	
	/**
	 * @param Google_Service_Slides_PageElementProperties
	 */
	public function setElementProperties(Google_Service_Slides_PageElementProperties $elementProperties)
	{
		$this->elementProperties = $elementProperties;
	}
	
	/**
	 * @return Google_Service_Slides_PageElementProperties
	 */
	public function getElementProperties()
	{
		return $this->elementProperties;
	}
	
	public function getObjectId()
	{
		return $this->objectId;
	}
	
	public function setObjectId($objectId)
	{
		$this->objectId = $objectId;
	}
	
	public function getShapeType()
	{
		return $this->shapeType;
	}
	
	public function setShapeType($shapeType)
	{
		$this->shapeType = $shapeType;
	}
}
