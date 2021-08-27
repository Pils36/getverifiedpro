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

class Google_Service_Blogger_CommentAuthor extends Google_Model
{
	public $displayName;
	public $id;
	public $url;
	protected $imageType = 'Google_Service_Blogger_CommentAuthorImage';
	protected $imageDataType = '';
	
	public function getDisplayName()
	{
		return $this->displayName;
	}
	
	public function setDisplayName($displayName)
	{
		$this->displayName = $displayName;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	/**
	 * @param Google_Service_Blogger_CommentAuthorImage
	 */
	public function setImage(Google_Service_Blogger_CommentAuthorImage $image)
	{
		$this->image = $image;
	}
	
	/**
	 * @return Google_Service_Blogger_CommentAuthorImage
	 */
	public function getImage()
	{
		return $this->image;
	}
	
	public function getUrl()
	{
		return $this->url;
	}
	
	public function setUrl($url)
	{
		$this->url = $url;
	}
}
