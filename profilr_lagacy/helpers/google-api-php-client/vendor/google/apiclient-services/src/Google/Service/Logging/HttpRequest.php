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

class Google_Service_Logging_HttpRequest extends Google_Model
{
	public $cacheFillBytes;
	public $cacheHit;
	public $cacheLookup;
	public $cacheValidatedWithOriginServer;
	public $latency;
	public $referer;
	public $remoteIp;
	public $requestMethod;
	public $requestSize;
	public $requestUrl;
	public $responseSize;
	public $serverIp;
	public $status;
	public $userAgent;
	
	public function getCacheFillBytes()
	{
		return $this->cacheFillBytes;
	}
	
	public function setCacheFillBytes($cacheFillBytes)
	{
		$this->cacheFillBytes = $cacheFillBytes;
	}
	
	public function getCacheHit()
	{
		return $this->cacheHit;
	}
	
	public function setCacheHit($cacheHit)
	{
		$this->cacheHit = $cacheHit;
	}
	
	public function getCacheLookup()
	{
		return $this->cacheLookup;
	}
	
	public function setCacheLookup($cacheLookup)
	{
		$this->cacheLookup = $cacheLookup;
	}
	
	public function getCacheValidatedWithOriginServer()
	{
		return $this->cacheValidatedWithOriginServer;
	}
	
	public function setCacheValidatedWithOriginServer($cacheValidatedWithOriginServer)
	{
		$this->cacheValidatedWithOriginServer = $cacheValidatedWithOriginServer;
	}
	
	public function getLatency()
	{
		return $this->latency;
	}
	
	public function setLatency($latency)
	{
		$this->latency = $latency;
	}
	
	public function getReferer()
	{
		return $this->referer;
	}
	
	public function setReferer($referer)
	{
		$this->referer = $referer;
	}
	
	public function getRemoteIp()
	{
		return $this->remoteIp;
	}
	
	public function setRemoteIp($remoteIp)
	{
		$this->remoteIp = $remoteIp;
	}
	
	public function getRequestMethod()
	{
		return $this->requestMethod;
	}
	
	public function setRequestMethod($requestMethod)
	{
		$this->requestMethod = $requestMethod;
	}
	
	public function getRequestSize()
	{
		return $this->requestSize;
	}
	
	public function setRequestSize($requestSize)
	{
		$this->requestSize = $requestSize;
	}
	
	public function getRequestUrl()
	{
		return $this->requestUrl;
	}
	
	public function setRequestUrl($requestUrl)
	{
		$this->requestUrl = $requestUrl;
	}
	
	public function getResponseSize()
	{
		return $this->responseSize;
	}
	
	public function setResponseSize($responseSize)
	{
		$this->responseSize = $responseSize;
	}
	
	public function getServerIp()
	{
		return $this->serverIp;
	}
	
	public function setServerIp($serverIp)
	{
		$this->serverIp = $serverIp;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function getUserAgent()
	{
		return $this->userAgent;
	}
	
	public function setUserAgent($userAgent)
	{
		$this->userAgent = $userAgent;
	}
}
