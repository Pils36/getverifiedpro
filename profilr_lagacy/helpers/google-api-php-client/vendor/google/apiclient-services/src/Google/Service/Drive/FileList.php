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

class Google_Service_Drive_FileList extends Google_Collection
{
	public $incompleteSearch;
	public $kind;
	public $nextPageToken;
	protected $collection_key = 'files';
	protected $filesType = 'Google_Service_Drive_DriveFile';
	protected $filesDataType = 'array';
	
	/**
	 * @param Google_Service_Drive_DriveFile
	 */
	public function setFiles($files)
	{
		$this->files = $files;
	}
	
	/**
	 * @return Google_Service_Drive_DriveFile
	 */
	public function getFiles()
	{
		return $this->files;
	}
	
	public function getIncompleteSearch()
	{
		return $this->incompleteSearch;
	}
	
	public function setIncompleteSearch($incompleteSearch)
	{
		$this->incompleteSearch = $incompleteSearch;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	public function getNextPageToken()
	{
		return $this->nextPageToken;
	}
	
	public function setNextPageToken($nextPageToken)
	{
		$this->nextPageToken = $nextPageToken;
	}
}
