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

class Google_Service_Books_VolumeVolumeInfo extends Google_Collection
{
	public $allowAnonLogging;
	public $authors;
	public $averageRating;
	public $canonicalVolumeLink;
	public $categories;
	public $contentVersion;
	public $description;
	public $infoLink;
	public $language;
	public $mainCategory;
	public $maturityRating;
	public $pageCount;
	public $previewLink;
	public $printType;
	public $printedPageCount;
	public $publishedDate;
	public $publisher;
	public $ratingsCount;
	public $readingModes;
	public $samplePageCount;
	public $subtitle;
	public $title;
	protected $collection_key = 'industryIdentifiers';
	protected $dimensionsType = 'Google_Service_Books_VolumeVolumeInfoDimensions';
	protected $dimensionsDataType = '';
	protected $imageLinksType = 'Google_Service_Books_VolumeVolumeInfoImageLinks';
	protected $imageLinksDataType = '';
	protected $industryIdentifiersType = 'Google_Service_Books_VolumeVolumeInfoIndustryIdentifiers';
	protected $industryIdentifiersDataType = 'array';
	protected $panelizationSummaryType = 'Google_Service_Books_VolumeVolumeInfoPanelizationSummary';
	protected $panelizationSummaryDataType = '';
	protected $seriesInfoType = 'Google_Service_Books_Volumeseriesinfo';
	protected $seriesInfoDataType = '';
	
	public function getAllowAnonLogging()
	{
		return $this->allowAnonLogging;
	}
	
	public function setAllowAnonLogging($allowAnonLogging)
	{
		$this->allowAnonLogging = $allowAnonLogging;
	}
	
	public function getAuthors()
	{
		return $this->authors;
	}
	
	public function setAuthors($authors)
	{
		$this->authors = $authors;
	}
	
	public function getAverageRating()
	{
		return $this->averageRating;
	}
	
	public function setAverageRating($averageRating)
	{
		$this->averageRating = $averageRating;
	}
	
	public function getCanonicalVolumeLink()
	{
		return $this->canonicalVolumeLink;
	}
	
	public function setCanonicalVolumeLink($canonicalVolumeLink)
	{
		$this->canonicalVolumeLink = $canonicalVolumeLink;
	}
	
	public function getCategories()
	{
		return $this->categories;
	}
	
	public function setCategories($categories)
	{
		$this->categories = $categories;
	}
	
	public function getContentVersion()
	{
		return $this->contentVersion;
	}
	
	public function setContentVersion($contentVersion)
	{
		$this->contentVersion = $contentVersion;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	/**
	 * @param Google_Service_Books_VolumeVolumeInfoDimensions
	 */
	public function setDimensions(Google_Service_Books_VolumeVolumeInfoDimensions $dimensions)
	{
		$this->dimensions = $dimensions;
	}
	
	/**
	 * @return Google_Service_Books_VolumeVolumeInfoDimensions
	 */
	public function getDimensions()
	{
		return $this->dimensions;
	}
	
	/**
	 * @param Google_Service_Books_VolumeVolumeInfoImageLinks
	 */
	public function setImageLinks(Google_Service_Books_VolumeVolumeInfoImageLinks $imageLinks)
	{
		$this->imageLinks = $imageLinks;
	}
	
	/**
	 * @return Google_Service_Books_VolumeVolumeInfoImageLinks
	 */
	public function getImageLinks()
	{
		return $this->imageLinks;
	}
	
	/**
	 * @param Google_Service_Books_VolumeVolumeInfoIndustryIdentifiers
	 */
	public function setIndustryIdentifiers($industryIdentifiers)
	{
		$this->industryIdentifiers = $industryIdentifiers;
	}
	
	/**
	 * @return Google_Service_Books_VolumeVolumeInfoIndustryIdentifiers
	 */
	public function getIndustryIdentifiers()
	{
		return $this->industryIdentifiers;
	}
	
	public function getInfoLink()
	{
		return $this->infoLink;
	}
	
	public function setInfoLink($infoLink)
	{
		$this->infoLink = $infoLink;
	}
	
	public function getLanguage()
	{
		return $this->language;
	}
	
	public function setLanguage($language)
	{
		$this->language = $language;
	}
	
	public function getMainCategory()
	{
		return $this->mainCategory;
	}
	
	public function setMainCategory($mainCategory)
	{
		$this->mainCategory = $mainCategory;
	}
	
	public function getMaturityRating()
	{
		return $this->maturityRating;
	}
	
	public function setMaturityRating($maturityRating)
	{
		$this->maturityRating = $maturityRating;
	}
	
	public function getPageCount()
	{
		return $this->pageCount;
	}
	
	public function setPageCount($pageCount)
	{
		$this->pageCount = $pageCount;
	}
	
	/**
	 * @param Google_Service_Books_VolumeVolumeInfoPanelizationSummary
	 */
	public function setPanelizationSummary(Google_Service_Books_VolumeVolumeInfoPanelizationSummary $panelizationSummary)
	{
		$this->panelizationSummary = $panelizationSummary;
	}
	
	/**
	 * @return Google_Service_Books_VolumeVolumeInfoPanelizationSummary
	 */
	public function getPanelizationSummary()
	{
		return $this->panelizationSummary;
	}
	
	public function getPreviewLink()
	{
		return $this->previewLink;
	}
	
	public function setPreviewLink($previewLink)
	{
		$this->previewLink = $previewLink;
	}
	
	public function getPrintType()
	{
		return $this->printType;
	}
	
	public function setPrintType($printType)
	{
		$this->printType = $printType;
	}
	
	public function getPrintedPageCount()
	{
		return $this->printedPageCount;
	}
	
	public function setPrintedPageCount($printedPageCount)
	{
		$this->printedPageCount = $printedPageCount;
	}
	
	public function getPublishedDate()
	{
		return $this->publishedDate;
	}
	
	public function setPublishedDate($publishedDate)
	{
		$this->publishedDate = $publishedDate;
	}
	
	public function getPublisher()
	{
		return $this->publisher;
	}
	
	public function setPublisher($publisher)
	{
		$this->publisher = $publisher;
	}
	
	public function getRatingsCount()
	{
		return $this->ratingsCount;
	}
	
	public function setRatingsCount($ratingsCount)
	{
		$this->ratingsCount = $ratingsCount;
	}
	
	public function getReadingModes()
	{
		return $this->readingModes;
	}
	
	public function setReadingModes($readingModes)
	{
		$this->readingModes = $readingModes;
	}
	
	public function getSamplePageCount()
	{
		return $this->samplePageCount;
	}
	
	public function setSamplePageCount($samplePageCount)
	{
		$this->samplePageCount = $samplePageCount;
	}
	
	/**
	 * @param Google_Service_Books_Volumeseriesinfo
	 */
	public function setSeriesInfo(Google_Service_Books_Volumeseriesinfo $seriesInfo)
	{
		$this->seriesInfo = $seriesInfo;
	}
	
	/**
	 * @return Google_Service_Books_Volumeseriesinfo
	 */
	public function getSeriesInfo()
	{
		return $this->seriesInfo;
	}
	
	public function getSubtitle()
	{
		return $this->subtitle;
	}
	
	public function setSubtitle($subtitle)
	{
		$this->subtitle = $subtitle;
	}
	
	public function getTitle()
	{
		return $this->title;
	}
	
	public function setTitle($title)
	{
		$this->title = $title;
	}
}
