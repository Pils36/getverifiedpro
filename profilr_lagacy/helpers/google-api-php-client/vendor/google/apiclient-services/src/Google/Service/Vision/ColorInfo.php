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

class Google_Service_Vision_ColorInfo extends Google_Model
{
	public $pixelFraction;
	public $score;
	protected $colorType = 'Google_Service_Vision_Color';
	protected $colorDataType = '';
	
	/**
	 * @param Google_Service_Vision_Color
	 */
	public function setColor(Google_Service_Vision_Color $color)
	{
		$this->color = $color;
	}
	
	/**
	 * @return Google_Service_Vision_Color
	 */
	public function getColor()
	{
		return $this->color;
	}
	
	public function getPixelFraction()
	{
		return $this->pixelFraction;
	}
	
	public function setPixelFraction($pixelFraction)
	{
		$this->pixelFraction = $pixelFraction;
	}
	
	public function getScore()
	{
		return $this->score;
	}
	
	public function setScore($score)
	{
		$this->score = $score;
	}
}
