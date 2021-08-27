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

class Google_Service_Slides_Shadow extends Google_Model
{
	public $alignment;
	public $alpha;
	public $propertyState;
	public $rotateWithShape;
	public $type;
	protected $blurRadiusType = 'Google_Service_Slides_Dimension';
	protected $blurRadiusDataType = '';
	protected $colorType = 'Google_Service_Slides_OpaqueColor';
	protected $colorDataType = '';
	protected $transformType = 'Google_Service_Slides_AffineTransform';
	protected $transformDataType = '';
	
	public function getAlignment()
	{
		return $this->alignment;
	}
	
	public function setAlignment($alignment)
	{
		$this->alignment = $alignment;
	}
	
	public function getAlpha()
	{
		return $this->alpha;
	}
	
	public function setAlpha($alpha)
	{
		$this->alpha = $alpha;
	}
	
	/**
	 * @param Google_Service_Slides_Dimension
	 */
	public function setBlurRadius(Google_Service_Slides_Dimension $blurRadius)
	{
		$this->blurRadius = $blurRadius;
	}
	
	/**
	 * @return Google_Service_Slides_Dimension
	 */
	public function getBlurRadius()
	{
		return $this->blurRadius;
	}
	
	/**
	 * @param Google_Service_Slides_OpaqueColor
	 */
	public function setColor(Google_Service_Slides_OpaqueColor $color)
	{
		$this->color = $color;
	}
	
	/**
	 * @return Google_Service_Slides_OpaqueColor
	 */
	public function getColor()
	{
		return $this->color;
	}
	
	public function getPropertyState()
	{
		return $this->propertyState;
	}
	
	public function setPropertyState($propertyState)
	{
		$this->propertyState = $propertyState;
	}
	
	public function getRotateWithShape()
	{
		return $this->rotateWithShape;
	}
	
	public function setRotateWithShape($rotateWithShape)
	{
		$this->rotateWithShape = $rotateWithShape;
	}
	
	/**
	 * @param Google_Service_Slides_AffineTransform
	 */
	public function setTransform(Google_Service_Slides_AffineTransform $transform)
	{
		$this->transform = $transform;
	}
	
	/**
	 * @return Google_Service_Slides_AffineTransform
	 */
	public function getTransform()
	{
		return $this->transform;
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function setType($type)
	{
		$this->type = $type;
	}
}
