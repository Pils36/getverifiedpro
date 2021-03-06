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

class Google_Service_Bigquery_TableDataList extends Google_Collection
{
	public $etag;
	public $kind;
	public $pageToken;
	public $totalRows;
	protected $collection_key = 'rows';
	protected $rowsType = 'Google_Service_Bigquery_TableRow';
	protected $rowsDataType = 'array';
	
	public function getEtag()
	{
		return $this->etag;
	}
	
	public function setEtag($etag)
	{
		$this->etag = $etag;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	public function getPageToken()
	{
		return $this->pageToken;
	}
	
	public function setPageToken($pageToken)
	{
		$this->pageToken = $pageToken;
	}
	
	/**
	 * @param Google_Service_Bigquery_TableRow
	 */
	public function setRows($rows)
	{
		$this->rows = $rows;
	}
	
	/**
	 * @return Google_Service_Bigquery_TableRow
	 */
	public function getRows()
	{
		return $this->rows;
	}
	
	public function getTotalRows()
	{
		return $this->totalRows;
	}
	
	public function setTotalRows($totalRows)
	{
		$this->totalRows = $totalRows;
	}
}
