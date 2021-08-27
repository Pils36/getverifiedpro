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

class Google_Service_Books_Layersummary extends Google_Collection
{
	public $annotationCount;
	public $annotationTypes;
	public $annotationsDataLink;
	public $annotationsLink;
	public $contentVersion;
	public $dataCount;
	public $id;
	public $kind;
	public $layerId;
	public $selfLink;
	public $updated;
	public $volumeAnnotationsVersion;
	public $volumeId;
	protected $collection_key = 'annotationTypes';
	
	public function getAnnotationCount()
	{
		return $this->annotationCount;
	}
	
	public function setAnnotationCount($annotationCount)
	{
		$this->annotationCount = $annotationCount;
	}
	
	public function getAnnotationTypes()
	{
		return $this->annotationTypes;
	}
	
	public function setAnnotationTypes($annotationTypes)
	{
		$this->annotationTypes = $annotationTypes;
	}
	
	public function getAnnotationsDataLink()
	{
		return $this->annotationsDataLink;
	}
	
	public function setAnnotationsDataLink($annotationsDataLink)
	{
		$this->annotationsDataLink = $annotationsDataLink;
	}
	
	public function getAnnotationsLink()
	{
		return $this->annotationsLink;
	}
	
	public function setAnnotationsLink($annotationsLink)
	{
		$this->annotationsLink = $annotationsLink;
	}
	
	public function getContentVersion()
	{
		return $this->contentVersion;
	}
	
	public function setContentVersion($contentVersion)
	{
		$this->contentVersion = $contentVersion;
	}
	
	public function getDataCount()
	{
		return $this->dataCount;
	}
	
	public function setDataCount($dataCount)
	{
		$this->dataCount = $dataCount;
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
	
	public function getLayerId()
	{
		return $this->layerId;
	}
	
	public function setLayerId($layerId)
	{
		$this->layerId = $layerId;
	}
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
	}
	
	public function getUpdated()
	{
		return $this->updated;
	}
	
	public function setUpdated($updated)
	{
		$this->updated = $updated;
	}
	
	public function getVolumeAnnotationsVersion()
	{
		return $this->volumeAnnotationsVersion;
	}
	
	public function setVolumeAnnotationsVersion($volumeAnnotationsVersion)
	{
		$this->volumeAnnotationsVersion = $volumeAnnotationsVersion;
	}
	
	public function getVolumeId()
	{
		return $this->volumeId;
	}
	
	public function setVolumeId($volumeId)
	{
		$this->volumeId = $volumeId;
	}
}
