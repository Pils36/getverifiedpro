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

class Google_Service_Drive_Comment extends Google_Collection
{
	public $anchor;
	public $content;
	public $createdTime;
	public $deleted;
	public $htmlContent;
	public $id;
	public $kind;
	public $modifiedTime;
	public $resolved;
	protected $collection_key = 'replies';
	protected $authorType = 'Google_Service_Drive_User';
	protected $authorDataType = '';
	protected $quotedFileContentType = 'Google_Service_Drive_CommentQuotedFileContent';
	protected $quotedFileContentDataType = '';
	protected $repliesType = 'Google_Service_Drive_Reply';
	protected $repliesDataType = 'array';
	
	public function getAnchor()
	{
		return $this->anchor;
	}
	
	public function setAnchor($anchor)
	{
		$this->anchor = $anchor;
	}
	
	/**
	 * @param Google_Service_Drive_User
	 */
	public function setAuthor(Google_Service_Drive_User $author)
	{
		$this->author = $author;
	}
	
	/**
	 * @return Google_Service_Drive_User
	 */
	public function getAuthor()
	{
		return $this->author;
	}
	
	public function getContent()
	{
		return $this->content;
	}
	
	public function setContent($content)
	{
		$this->content = $content;
	}
	
	public function getCreatedTime()
	{
		return $this->createdTime;
	}
	
	public function setCreatedTime($createdTime)
	{
		$this->createdTime = $createdTime;
	}
	
	public function getDeleted()
	{
		return $this->deleted;
	}
	
	public function setDeleted($deleted)
	{
		$this->deleted = $deleted;
	}
	
	public function getHtmlContent()
	{
		return $this->htmlContent;
	}
	
	public function setHtmlContent($htmlContent)
	{
		$this->htmlContent = $htmlContent;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	public function getModifiedTime()
	{
		return $this->modifiedTime;
	}
	
	public function setModifiedTime($modifiedTime)
	{
		$this->modifiedTime = $modifiedTime;
	}
	
	/**
	 * @param Google_Service_Drive_CommentQuotedFileContent
	 */
	public function setQuotedFileContent(Google_Service_Drive_CommentQuotedFileContent $quotedFileContent)
	{
		$this->quotedFileContent = $quotedFileContent;
	}
	
	/**
	 * @return Google_Service_Drive_CommentQuotedFileContent
	 */
	public function getQuotedFileContent()
	{
		return $this->quotedFileContent;
	}
	
	/**
	 * @param Google_Service_Drive_Reply
	 */
	public function setReplies($replies)
	{
		$this->replies = $replies;
	}
	
	/**
	 * @return Google_Service_Drive_Reply
	 */
	public function getReplies()
	{
		return $this->replies;
	}
	
	public function getResolved()
	{
		return $this->resolved;
	}
	
	public function setResolved($resolved)
	{
		$this->resolved = $resolved;
	}
}
