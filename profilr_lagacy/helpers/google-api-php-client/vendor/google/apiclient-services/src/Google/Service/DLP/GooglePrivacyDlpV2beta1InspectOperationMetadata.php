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

class Google_Service_DLP_GooglePrivacyDlpV2beta1InspectOperationMetadata extends Google_Collection
{
	public $createTime;
	public $processedBytes;
	public $totalEstimatedBytes;
	protected $collection_key = 'infoTypeStats';
	protected $infoTypeStatsType = 'Google_Service_DLP_GooglePrivacyDlpV2beta1InfoTypeStatistics';
	protected $infoTypeStatsDataType = 'array';
	protected $requestInspectConfigType = 'Google_Service_DLP_GooglePrivacyDlpV2beta1InspectConfig';
	protected $requestInspectConfigDataType = '';
	protected $requestOutputConfigType = 'Google_Service_DLP_GooglePrivacyDlpV2beta1OutputStorageConfig';
	protected $requestOutputConfigDataType = '';
	protected $requestStorageConfigType = 'Google_Service_DLP_GooglePrivacyDlpV2beta1StorageConfig';
	protected $requestStorageConfigDataType = '';
	
	public function getCreateTime()
	{
		return $this->createTime;
	}
	
	public function setCreateTime($createTime)
	{
		$this->createTime = $createTime;
	}
	
	/**
	 * @param Google_Service_DLP_GooglePrivacyDlpV2beta1InfoTypeStatistics
	 */
	public function setInfoTypeStats($infoTypeStats)
	{
		$this->infoTypeStats = $infoTypeStats;
	}
	
	/**
	 * @return Google_Service_DLP_GooglePrivacyDlpV2beta1InfoTypeStatistics
	 */
	public function getInfoTypeStats()
	{
		return $this->infoTypeStats;
	}
	
	public function getProcessedBytes()
	{
		return $this->processedBytes;
	}
	
	public function setProcessedBytes($processedBytes)
	{
		$this->processedBytes = $processedBytes;
	}
	
	/**
	 * @param Google_Service_DLP_GooglePrivacyDlpV2beta1InspectConfig
	 */
	public function setRequestInspectConfig(Google_Service_DLP_GooglePrivacyDlpV2beta1InspectConfig $requestInspectConfig)
	{
		$this->requestInspectConfig = $requestInspectConfig;
	}
	
	/**
	 * @return Google_Service_DLP_GooglePrivacyDlpV2beta1InspectConfig
	 */
	public function getRequestInspectConfig()
	{
		return $this->requestInspectConfig;
	}
	
	/**
	 * @param Google_Service_DLP_GooglePrivacyDlpV2beta1OutputStorageConfig
	 */
	public function setRequestOutputConfig(Google_Service_DLP_GooglePrivacyDlpV2beta1OutputStorageConfig $requestOutputConfig)
	{
		$this->requestOutputConfig = $requestOutputConfig;
	}
	
	/**
	 * @return Google_Service_DLP_GooglePrivacyDlpV2beta1OutputStorageConfig
	 */
	public function getRequestOutputConfig()
	{
		return $this->requestOutputConfig;
	}
	
	/**
	 * @param Google_Service_DLP_GooglePrivacyDlpV2beta1StorageConfig
	 */
	public function setRequestStorageConfig(Google_Service_DLP_GooglePrivacyDlpV2beta1StorageConfig $requestStorageConfig)
	{
		$this->requestStorageConfig = $requestStorageConfig;
	}
	
	/**
	 * @return Google_Service_DLP_GooglePrivacyDlpV2beta1StorageConfig
	 */
	public function getRequestStorageConfig()
	{
		return $this->requestStorageConfig;
	}
	
	public function getTotalEstimatedBytes()
	{
		return $this->totalEstimatedBytes;
	}
	
	public function setTotalEstimatedBytes($totalEstimatedBytes)
	{
		$this->totalEstimatedBytes = $totalEstimatedBytes;
	}
}
