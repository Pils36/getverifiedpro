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

class Google_Service_Books_OffersItems extends Google_Collection
{
	public $artUrl;
	public $gservicesKey;
	public $id;
	protected $collection_key = 'items';
	protected $itemsType = 'Google_Service_Books_OffersItemsItems';
	protected $itemsDataType = 'array';
	
	public function getArtUrl()
	{
		return $this->artUrl;
	}
	
	public function setArtUrl($artUrl)
	{
		$this->artUrl = $artUrl;
	}
	
	public function getGservicesKey()
	{
		return $this->gservicesKey;
	}
	
	public function setGservicesKey($gservicesKey)
	{
		$this->gservicesKey = $gservicesKey;
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
	 * @param Google_Service_Books_OffersItemsItems
	 */
	public function setItems($items)
	{
		$this->items = $items;
	}
	
	/**
	 * @return Google_Service_Books_OffersItemsItems
	 */
	public function getItems()
	{
		return $this->items;
	}
}
