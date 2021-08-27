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

class Google_Service_Bigquery_GetQueryResultsResponse extends Google_Collection
{
	public $cacheHit;
	public $etag;
	public $jobComplete;
	public $kind;
	public $numDmlAffectedRows;
	public $pageToken;
	public $totalBytesProcessed;
	public $totalRows;
	protected $collection_key = 'rows';
	protected $errorsType = 'Google_Service_Bigquery_ErrorProto';
	protected $errorsDataType = 'array';
	protected $jobReferenceType = 'Google_Service_Bigquery_JobReference';
	protected $jobReferenceDataType = '';
	protected $rowsType = 'Google_Service_Bigquery_TableRow';
	protected $rowsDataType = 'array';
	protected $schemaType = 'Google_Service_Bigquery_TableSchema';
	protected $schemaDataType = '';
	
	public function getCacheHit()
	{
		return $this->cacheHit;
	}
	
	public function setCacheHit($cacheHit)
	{
		$this->cacheHit = $cacheHit;
	}
	
	/**
	 * @param Google_Service_Bigquery_ErrorProto
	 */
	public function setErrors($errors)
	{
		$this->errors = $errors;
	}
	
	/**
	 * @return Google_Service_Bigquery_ErrorProto
	 */
	public function getErrors()
	{
		return $this->errors;
	}
	
	public function getEtag()
	{
		return $this->etag;
	}
	
	public function setEtag($etag)
	{
		$this->etag = $etag;
	}
	
	public function getJobComplete()
	{
		return $this->jobComplete;
	}
	
	public function setJobComplete($jobComplete)
	{
		$this->jobComplete = $jobComplete;
	}
	
	/**
	 * @param Google_Service_Bigquery_JobReference
	 */
	public function setJobReference(Google_Service_Bigquery_JobReference $jobReference)
	{
		$this->jobReference = $jobReference;
	}
	
	/**
	 * @return Google_Service_Bigquery_JobReference
	 */
	public function getJobReference()
	{
		return $this->jobReference;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	public function getNumDmlAffectedRows()
	{
		return $this->numDmlAffectedRows;
	}
	
	public function setNumDmlAffectedRows($numDmlAffectedRows)
	{
		$this->numDmlAffectedRows = $numDmlAffectedRows;
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
	
	/**
	 * @param Google_Service_Bigquery_TableSchema
	 */
	public function setSchema(Google_Service_Bigquery_TableSchema $schema)
	{
		$this->schema = $schema;
	}
	
	/**
	 * @return Google_Service_Bigquery_TableSchema
	 */
	public function getSchema()
	{
		return $this->schema;
	}
	
	public function getTotalBytesProcessed()
	{
		return $this->totalBytesProcessed;
	}
	
	public function setTotalBytesProcessed($totalBytesProcessed)
	{
		$this->totalBytesProcessed = $totalBytesProcessed;
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
