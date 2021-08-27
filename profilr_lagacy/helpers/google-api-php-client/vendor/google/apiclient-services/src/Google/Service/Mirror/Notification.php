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

class Google_Service_Mirror_Notification extends Google_Collection
{
	public $collection;
	public $itemId;
	public $operation;
	public $userToken;
	public $verifyToken;
	protected $collection_key = 'userActions';
	protected $userActionsType = 'Google_Service_Mirror_UserAction';
	protected $userActionsDataType = 'array';
	
	public function getCollection()
	{
		return $this->collection;
	}
	
	public function setCollection($collection)
	{
		$this->collection = $collection;
	}
	
	public function getItemId()
	{
		return $this->itemId;
	}
	
	public function setItemId($itemId)
	{
		$this->itemId = $itemId;
	}
	
	public function getOperation()
	{
		return $this->operation;
	}
	
	public function setOperation($operation)
	{
		$this->operation = $operation;
	}
	
	/**
	 * @param Google_Service_Mirror_UserAction
	 */
	public function setUserActions($userActions)
	{
		$this->userActions = $userActions;
	}
	
	/**
	 * @return Google_Service_Mirror_UserAction
	 */
	public function getUserActions()
	{
		return $this->userActions;
	}
	
	public function getUserToken()
	{
		return $this->userToken;
	}
	
	public function setUserToken($userToken)
	{
		$this->userToken = $userToken;
	}
	
	public function getVerifyToken()
	{
		return $this->verifyToken;
	}
	
	public function setVerifyToken($verifyToken)
	{
		$this->verifyToken = $verifyToken;
	}
}
