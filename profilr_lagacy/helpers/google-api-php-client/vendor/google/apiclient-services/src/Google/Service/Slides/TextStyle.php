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

class Google_Service_Slides_TextStyle extends Google_Model
{
	public $baselineOffset;
	public $bold;
	public $fontFamily;
	public $italic;
	public $smallCaps;
	public $strikethrough;
	public $underline;
	protected $backgroundColorType = 'Google_Service_Slides_OptionalColor';
	protected $backgroundColorDataType = '';
	protected $fontSizeType = 'Google_Service_Slides_Dimension';
	protected $fontSizeDataType = '';
	protected $foregroundColorType = 'Google_Service_Slides_OptionalColor';
	protected $foregroundColorDataType = '';
	protected $linkType = 'Google_Service_Slides_Link';
	protected $linkDataType = '';
	protected $weightedFontFamilyType = 'Google_Service_Slides_WeightedFontFamily';
	protected $weightedFontFamilyDataType = '';
	
	/**
	 * @param Google_Service_Slides_OptionalColor
	 */
	public function setBackgroundColor(Google_Service_Slides_OptionalColor $backgroundColor)
	{
		$this->backgroundColor = $backgroundColor;
	}
	
	/**
	 * @return Google_Service_Slides_OptionalColor
	 */
	public function getBackgroundColor()
	{
		return $this->backgroundColor;
	}
	
	public function getBaselineOffset()
	{
		return $this->baselineOffset;
	}
	
	public function setBaselineOffset($baselineOffset)
	{
		$this->baselineOffset = $baselineOffset;
	}
	
	public function getBold()
	{
		return $this->bold;
	}
	
	public function setBold($bold)
	{
		$this->bold = $bold;
	}
	
	public function getFontFamily()
	{
		return $this->fontFamily;
	}
	
	public function setFontFamily($fontFamily)
	{
		$this->fontFamily = $fontFamily;
	}
	
	/**
	 * @param Google_Service_Slides_Dimension
	 */
	public function setFontSize(Google_Service_Slides_Dimension $fontSize)
	{
		$this->fontSize = $fontSize;
	}
	
	/**
	 * @return Google_Service_Slides_Dimension
	 */
	public function getFontSize()
	{
		return $this->fontSize;
	}
	
	/**
	 * @param Google_Service_Slides_OptionalColor
	 */
	public function setForegroundColor(Google_Service_Slides_OptionalColor $foregroundColor)
	{
		$this->foregroundColor = $foregroundColor;
	}
	
	/**
	 * @return Google_Service_Slides_OptionalColor
	 */
	public function getForegroundColor()
	{
		return $this->foregroundColor;
	}
	
	public function getItalic()
	{
		return $this->italic;
	}
	
	public function setItalic($italic)
	{
		$this->italic = $italic;
	}
	
	/**
	 * @param Google_Service_Slides_Link
	 */
	public function setLink(Google_Service_Slides_Link $link)
	{
		$this->link = $link;
	}
	
	/**
	 * @return Google_Service_Slides_Link
	 */
	public function getLink()
	{
		return $this->link;
	}
	
	public function getSmallCaps()
	{
		return $this->smallCaps;
	}
	
	public function setSmallCaps($smallCaps)
	{
		$this->smallCaps = $smallCaps;
	}
	
	public function getStrikethrough()
	{
		return $this->strikethrough;
	}
	
	public function setStrikethrough($strikethrough)
	{
		$this->strikethrough = $strikethrough;
	}
	
	public function getUnderline()
	{
		return $this->underline;
	}
	
	public function setUnderline($underline)
	{
		$this->underline = $underline;
	}
	
	/**
	 * @param Google_Service_Slides_WeightedFontFamily
	 */
	public function setWeightedFontFamily(Google_Service_Slides_WeightedFontFamily $weightedFontFamily)
	{
		$this->weightedFontFamily = $weightedFontFamily;
	}
	
	/**
	 * @return Google_Service_Slides_WeightedFontFamily
	 */
	public function getWeightedFontFamily()
	{
		return $this->weightedFontFamily;
	}
}
