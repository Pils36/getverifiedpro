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

class Google_Service_Blogger_Pageviews extends Google_Collection
{
	public $blogId;
	public $kind;
	protected $collection_key = 'counts';
	protected $countsType = 'Google_Service_Blogger_PageviewsCounts';
	protected $countsDataType = 'array';
	
	public function getBlogId()
	{
		return $this->blogId;
	}
	
	public function setBlogId($blogId)
	{
		$this->blogId = $blogId;
	}
	
	/**
	 * @param Google_Service_Blogger_PageviewsCounts
	 */
	public function setCounts($counts)
	{
		$this->counts = $counts;
	}
	
	/**
	 * @return Google_Service_Blogger_PageviewsCounts
	 */
	public function getCounts()
	{
		return $this->counts;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
}
