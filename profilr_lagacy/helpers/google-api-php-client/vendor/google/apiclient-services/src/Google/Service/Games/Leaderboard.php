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

class Google_Service_Games_Leaderboard extends Google_Model
{
	public $iconUrl;
	public $id;
	public $isIconUrlDefault;
	public $kind;
	public $name;
	public $order;
	
	public function getIconUrl()
	{
		return $this->iconUrl;
	}
	
	public function setIconUrl($iconUrl)
	{
		$this->iconUrl = $iconUrl;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getIsIconUrlDefault()
	{
		return $this->isIconUrlDefault;
	}
	
	public function setIsIconUrlDefault($isIconUrlDefault)
	{
		$this->isIconUrlDefault = $isIconUrlDefault;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getOrder()
	{
		return $this->order;
	}
	
	public function setOrder($order)
	{
		$this->order = $order;
	}
}
