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

class Google_Service_Bigquery_ExternalDataConfiguration extends Google_Collection
{
	public $autodetect;
	public $compression;
	public $ignoreUnknownValues;
	public $maxBadRecords;
	public $sourceFormat;
	public $sourceUris;
	protected $collection_key = 'sourceUris';
	protected $bigtableOptionsType = 'Google_Service_Bigquery_BigtableOptions';
	protected $bigtableOptionsDataType = '';
	protected $csvOptionsType = 'Google_Service_Bigquery_CsvOptions';
	protected $csvOptionsDataType = '';
	protected $googleSheetsOptionsType = 'Google_Service_Bigquery_GoogleSheetsOptions';
	protected $googleSheetsOptionsDataType = '';
	protected $schemaType = 'Google_Service_Bigquery_TableSchema';
	protected $schemaDataType = '';
	
	public function getAutodetect()
	{
		return $this->autodetect;
	}
	
	public function setAutodetect($autodetect)
	{
		$this->autodetect = $autodetect;
	}
	
	/**
	 * @param Google_Service_Bigquery_BigtableOptions
	 */
	public function setBigtableOptions(Google_Service_Bigquery_BigtableOptions $bigtableOptions)
	{
		$this->bigtableOptions = $bigtableOptions;
	}
	
	/**
	 * @return Google_Service_Bigquery_BigtableOptions
	 */
	public function getBigtableOptions()
	{
		return $this->bigtableOptions;
	}
	
	public function getCompression()
	{
		return $this->compression;
	}
	
	public function setCompression($compression)
	{
		$this->compression = $compression;
	}
	
	/**
	 * @param Google_Service_Bigquery_CsvOptions
	 */
	public function setCsvOptions(Google_Service_Bigquery_CsvOptions $csvOptions)
	{
		$this->csvOptions = $csvOptions;
	}
	
	/**
	 * @return Google_Service_Bigquery_CsvOptions
	 */
	public function getCsvOptions()
	{
		return $this->csvOptions;
	}
	
	/**
	 * @param Google_Service_Bigquery_GoogleSheetsOptions
	 */
	public function setGoogleSheetsOptions(Google_Service_Bigquery_GoogleSheetsOptions $googleSheetsOptions)
	{
		$this->googleSheetsOptions = $googleSheetsOptions;
	}
	
	/**
	 * @return Google_Service_Bigquery_GoogleSheetsOptions
	 */
	public function getGoogleSheetsOptions()
	{
		return $this->googleSheetsOptions;
	}
	
	public function getIgnoreUnknownValues()
	{
		return $this->ignoreUnknownValues;
	}
	
	public function setIgnoreUnknownValues($ignoreUnknownValues)
	{
		$this->ignoreUnknownValues = $ignoreUnknownValues;
	}
	
	public function getMaxBadRecords()
	{
		return $this->maxBadRecords;
	}
	
	public function setMaxBadRecords($maxBadRecords)
	{
		$this->maxBadRecords = $maxBadRecords;
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
	
	public function getSourceFormat()
	{
		return $this->sourceFormat;
	}
	
	public function setSourceFormat($sourceFormat)
	{
		$this->sourceFormat = $sourceFormat;
	}
	
	public function getSourceUris()
	{
		return $this->sourceUris;
	}
	
	public function setSourceUris($sourceUris)
	{
		$this->sourceUris = $sourceUris;
	}
}
