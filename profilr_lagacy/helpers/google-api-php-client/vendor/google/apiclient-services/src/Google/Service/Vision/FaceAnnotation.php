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

class Google_Service_Vision_FaceAnnotation extends Google_Collection
{
	public $angerLikelihood;
	public $blurredLikelihood;
	public $detectionConfidence;
	public $headwearLikelihood;
	public $joyLikelihood;
	public $landmarkingConfidence;
	public $panAngle;
	public $rollAngle;
	public $sorrowLikelihood;
	public $surpriseLikelihood;
	public $tiltAngle;
	public $underExposedLikelihood;
	protected $collection_key = 'landmarks';
	protected $boundingPolyType = 'Google_Service_Vision_BoundingPoly';
	protected $boundingPolyDataType = '';
	protected $fdBoundingPolyType = 'Google_Service_Vision_BoundingPoly';
	protected $fdBoundingPolyDataType = '';
	protected $landmarksType = 'Google_Service_Vision_Landmark';
	protected $landmarksDataType = 'array';
	
	public function getAngerLikelihood()
	{
		return $this->angerLikelihood;
	}
	
	public function setAngerLikelihood($angerLikelihood)
	{
		$this->angerLikelihood = $angerLikelihood;
	}
	
	public function getBlurredLikelihood()
	{
		return $this->blurredLikelihood;
	}
	
	public function setBlurredLikelihood($blurredLikelihood)
	{
		$this->blurredLikelihood = $blurredLikelihood;
	}
	
	/**
	 * @param Google_Service_Vision_BoundingPoly
	 */
	public function setBoundingPoly(Google_Service_Vision_BoundingPoly $boundingPoly)
	{
		$this->boundingPoly = $boundingPoly;
	}
	
	/**
	 * @return Google_Service_Vision_BoundingPoly
	 */
	public function getBoundingPoly()
	{
		return $this->boundingPoly;
	}
	
	public function getDetectionConfidence()
	{
		return $this->detectionConfidence;
	}
	
	public function setDetectionConfidence($detectionConfidence)
	{
		$this->detectionConfidence = $detectionConfidence;
	}
	
	/**
	 * @param Google_Service_Vision_BoundingPoly
	 */
	public function setFdBoundingPoly(Google_Service_Vision_BoundingPoly $fdBoundingPoly)
	{
		$this->fdBoundingPoly = $fdBoundingPoly;
	}
	
	/**
	 * @return Google_Service_Vision_BoundingPoly
	 */
	public function getFdBoundingPoly()
	{
		return $this->fdBoundingPoly;
	}
	
	public function getHeadwearLikelihood()
	{
		return $this->headwearLikelihood;
	}
	
	public function setHeadwearLikelihood($headwearLikelihood)
	{
		$this->headwearLikelihood = $headwearLikelihood;
	}
	
	public function getJoyLikelihood()
	{
		return $this->joyLikelihood;
	}
	
	public function setJoyLikelihood($joyLikelihood)
	{
		$this->joyLikelihood = $joyLikelihood;
	}
	
	public function getLandmarkingConfidence()
	{
		return $this->landmarkingConfidence;
	}
	
	public function setLandmarkingConfidence($landmarkingConfidence)
	{
		$this->landmarkingConfidence = $landmarkingConfidence;
	}
	
	/**
	 * @param Google_Service_Vision_Landmark
	 */
	public function setLandmarks($landmarks)
	{
		$this->landmarks = $landmarks;
	}
	
	/**
	 * @return Google_Service_Vision_Landmark
	 */
	public function getLandmarks()
	{
		return $this->landmarks;
	}
	
	public function getPanAngle()
	{
		return $this->panAngle;
	}
	
	public function setPanAngle($panAngle)
	{
		$this->panAngle = $panAngle;
	}
	
	public function getRollAngle()
	{
		return $this->rollAngle;
	}
	
	public function setRollAngle($rollAngle)
	{
		$this->rollAngle = $rollAngle;
	}
	
	public function getSorrowLikelihood()
	{
		return $this->sorrowLikelihood;
	}
	
	public function setSorrowLikelihood($sorrowLikelihood)
	{
		$this->sorrowLikelihood = $sorrowLikelihood;
	}
	
	public function getSurpriseLikelihood()
	{
		return $this->surpriseLikelihood;
	}
	
	public function setSurpriseLikelihood($surpriseLikelihood)
	{
		$this->surpriseLikelihood = $surpriseLikelihood;
	}
	
	public function getTiltAngle()
	{
		return $this->tiltAngle;
	}
	
	public function setTiltAngle($tiltAngle)
	{
		$this->tiltAngle = $tiltAngle;
	}
	
	public function getUnderExposedLikelihood()
	{
		return $this->underExposedLikelihood;
	}
	
	public function setUnderExposedLikelihood($underExposedLikelihood)
	{
		$this->underExposedLikelihood = $underExposedLikelihood;
	}
}
