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

class Google_Service_Blogger_User extends Google_Model
{
	public $about;
	public $created;
	public $displayName;
	public $id;
	public $kind;
	public $selfLink;
	public $url;
	protected $blogsType = 'Google_Service_Blogger_UserBlogs';
	protected $blogsDataType = '';
	protected $localeType = 'Google_Service_Blogger_UserLocale';
	protected $localeDataType = '';
	
	public function getAbout()
	{
		return $this->about;
	}
	
	public function setAbout($about)
	{
		$this->about = $about;
	}
	
	/**
	 * @param Google_Service_Blogger_UserBlogs
	 */
	public function setBlogs(Google_Service_Blogger_UserBlogs $blogs)
	{
		$this->blogs = $blogs;
	}
	
	/**
	 * @return Google_Service_Blogger_UserBlogs
	 */
	public function getBlogs()
	{
		return $this->blogs;
	}
	
	public function getCreated()
	{
		return $this->created;
	}
	
	public function setCreated($created)
	{
		$this->created = $created;
	}
	
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
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	/**
	 * @param Google_Service_Blogger_UserLocale
	 */
	public function setLocale(Google_Service_Blogger_UserLocale $locale)
	{
		$this->locale = $locale;
	}
	
	/**
	 * @return Google_Service_Blogger_UserLocale
	 */
	public function getLocale()
	{
		return $this->locale;
	}
	
	public function getSelfLink()
	{
		return $this->selfLink;
	}
	
	public function setSelfLink($selfLink)
	{
		$this->selfLink = $selfLink;
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
