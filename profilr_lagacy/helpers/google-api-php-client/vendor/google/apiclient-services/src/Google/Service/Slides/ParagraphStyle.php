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

class Google_Service_Slides_ParagraphStyle extends Google_Model
{
	public $alignment;
	public $direction;
	public $lineSpacing;
	public $spacingMode;
	protected $indentEndType = 'Google_Service_Slides_Dimension';
	protected $indentEndDataType = '';
	protected $indentFirstLineType = 'Google_Service_Slides_Dimension';
	protected $indentFirstLineDataType = '';
	protected $indentStartType = 'Google_Service_Slides_Dimension';
	protected $indentStartDataType = '';
	protected $spaceAboveType = 'Google_Service_Slides_Dimension';
	protected $spaceAboveDataType = '';
	protected $spaceBelowType = 'Google_Service_Slides_Dimension';
	protected $spaceBelowDataType = '';
	
	public function getAlignment()
	{
		return $this->alignment;
	}
	
	public function setAlignment($alignment)
	{
		$this->alignment = $alignment;
	}
	
	public function getDirection()
	{
		return $this->direction;
	}
	
	public function setDirection($direction)
	{
		$this->direction = $direction;
	}
	
	/**
	 * @param Google_Service_Slides_Dimension
	 */
	public function setIndentEnd(Google_Service_Slides_Dimension $indentEnd)
	{
		$this->indentEnd = $indentEnd;
	}
	
	/**
	 * @return Google_Service_Slides_Dimension
	 */
	public function getIndentEnd()
	{
		return $this->indentEnd;
	}
	
	/**
	 * @param Google_Service_Slides_Dimension
	 */
	public function setIndentFirstLine(Google_Service_Slides_Dimension $indentFirstLine)
	{
		$this->indentFirstLine = $indentFirstLine;
	}
	
	/**
	 * @return Google_Service_Slides_Dimension
	 */
	public function getIndentFirstLine()
	{
		return $this->indentFirstLine;
	}
	
	/**
	 * @param Google_Service_Slides_Dimension
	 */
	public function setIndentStart(Google_Service_Slides_Dimension $indentStart)
	{
		$this->indentStart = $indentStart;
	}
	
	/**
	 * @return Google_Service_Slides_Dimension
	 */
	public function getIndentStart()
	{
		return $this->indentStart;
	}
	
	public function getLineSpacing()
	{
		return $this->lineSpacing;
	}
	
	public function setLineSpacing($lineSpacing)
	{
		$this->lineSpacing = $lineSpacing;
	}
	
	/**
	 * @param Google_Service_Slides_Dimension
	 */
	public function setSpaceAbove(Google_Service_Slides_Dimension $spaceAbove)
	{
		$this->spaceAbove = $spaceAbove;
	}
	
	/**
	 * @return Google_Service_Slides_Dimension
	 */
	public function getSpaceAbove()
	{
		return $this->spaceAbove;
	}
	
	/**
	 * @param Google_Service_Slides_Dimension
	 */
	public function setSpaceBelow(Google_Service_Slides_Dimension $spaceBelow)
	{
		$this->spaceBelow = $spaceBelow;
	}
	
	/**
	 * @return Google_Service_Slides_Dimension
	 */
	public function getSpaceBelow()
	{
		return $this->spaceBelow;
	}
	
	public function getSpacingMode()
	{
		return $this->spacingMode;
	}
	
	public function setSpacingMode($spacingMode)
	{
		$this->spacingMode = $spacingMode;
	}
}
