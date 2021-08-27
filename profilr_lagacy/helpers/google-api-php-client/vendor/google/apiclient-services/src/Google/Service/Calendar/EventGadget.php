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

class Google_Service_Calendar_EventGadget extends Google_Model
{
	public $display;
	public $height;
	public $iconLink;
	public $link;
	public $preferences;
	public $title;
	public $type;
	public $width;
	
	public function getDisplay()
	{
		return $this->display;
	}
	
	public function setDisplay($display)
	{
		$this->display = $display;
	}
	
	public function getHeight()
	{
		return $this->height;
	}
	
	public function setHeight($height)
	{
		$this->height = $height;
	}
	
	public function getIconLink()
	{
		return $this->iconLink;
	}
	
	public function setIconLink($iconLink)
	{
		$this->iconLink = $iconLink;
	}
	
	public function getLink()
	{
		return $this->link;
	}
	
	public function setLink($link)
	{
		$this->link = $link;
	}
	
	public function getPreferences()
	{
		return $this->preferences;
	}
	
	public function setPreferences($preferences)
	{
		$this->preferences = $preferences;
	}
	
	public function getTitle()
	{
		return $this->title;
	}
	
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function setType($type)
	{
		$this->type = $type;
	}
	
	public function getWidth()
	{
		return $this->width;
	}
	
	public function setWidth($width)
	{
		$this->width = $width;
	}
}
