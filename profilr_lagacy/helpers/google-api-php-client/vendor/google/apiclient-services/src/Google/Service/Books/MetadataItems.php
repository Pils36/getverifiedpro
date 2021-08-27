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

class Google_Service_Books_MetadataItems extends Google_Model
{
	public $downloadUrl;
	public $encryptedKey;
	public $language;
	public $size;
	public $version;
	protected $internal_gapi_mappings = array(
		"downloadUrl" => "download_url",
		"encryptedKey" => "encrypted_key",
	);
	
	public function getDownloadUrl()
	{
		return $this->downloadUrl;
	}
	
	public function setDownloadUrl($downloadUrl)
	{
		$this->downloadUrl = $downloadUrl;
	}
	
	public function getEncryptedKey()
	{
		return $this->encryptedKey;
	}
	
	public function setEncryptedKey($encryptedKey)
	{
		$this->encryptedKey = $encryptedKey;
	}
	
	public function getLanguage()
	{
		return $this->language;
	}
	
	public function setLanguage($language)
	{
		$this->language = $language;
	}
	
	public function getSize()
	{
		return $this->size;
	}
	
	public function setSize($size)
	{
		$this->size = $size;
	}
	
	public function getVersion()
	{
		return $this->version;
	}
	
	public function setVersion($version)
	{
		$this->version = $version;
	}
}
