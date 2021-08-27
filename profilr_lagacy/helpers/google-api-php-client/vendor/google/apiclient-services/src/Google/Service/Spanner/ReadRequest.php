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

class Google_Service_Spanner_ReadRequest extends Google_Collection
{
	public $columns;
	public $index;
	public $limit;
	public $resumeToken;
	public $table;
	protected $collection_key = 'columns';
	protected $keySetType = 'Google_Service_Spanner_KeySet';
	protected $keySetDataType = '';
	protected $transactionType = 'Google_Service_Spanner_TransactionSelector';
	protected $transactionDataType = '';
	
	public function getColumns()
	{
		return $this->columns;
	}
	
	public function setColumns($columns)
	{
		$this->columns = $columns;
	}
	
	public function getIndex()
	{
		return $this->index;
	}
	
	public function setIndex($index)
	{
		$this->index = $index;
	}
	
	/**
	 * @param Google_Service_Spanner_KeySet
	 */
	public function setKeySet(Google_Service_Spanner_KeySet $keySet)
	{
		$this->keySet = $keySet;
	}
	
	/**
	 * @return Google_Service_Spanner_KeySet
	 */
	public function getKeySet()
	{
		return $this->keySet;
	}
	
	public function getLimit()
	{
		return $this->limit;
	}
	
	public function setLimit($limit)
	{
		$this->limit = $limit;
	}
	
	public function getResumeToken()
	{
		return $this->resumeToken;
	}
	
	public function setResumeToken($resumeToken)
	{
		$this->resumeToken = $resumeToken;
	}
	
	public function getTable()
	{
		return $this->table;
	}
	
	public function setTable($table)
	{
		$this->table = $table;
	}
	
	/**
	 * @param Google_Service_Spanner_TransactionSelector
	 */
	public function setTransaction(Google_Service_Spanner_TransactionSelector $transaction)
	{
		$this->transaction = $transaction;
	}
	
	/**
	 * @return Google_Service_Spanner_TransactionSelector
	 */
	public function getTransaction()
	{
		return $this->transaction;
	}
}
