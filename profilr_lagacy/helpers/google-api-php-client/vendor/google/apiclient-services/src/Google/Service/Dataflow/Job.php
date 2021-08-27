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

class Google_Service_Dataflow_Job extends Google_Collection
{
	public $clientRequestId;
	public $createTime;
	public $currentState;
	public $currentStateTime;
	public $id;
	public $labels;
	public $location;
	public $name;
	public $projectId;
	public $replaceJobId;
	public $replacedByJobId;
	public $requestedState;
	public $tempFiles;
	public $transformNameMapping;
	public $type;
	protected $collection_key = 'tempFiles';
	protected $environmentType = 'Google_Service_Dataflow_Environment';
	protected $environmentDataType = '';
	protected $executionInfoType = 'Google_Service_Dataflow_JobExecutionInfo';
	protected $executionInfoDataType = '';
	protected $pipelineDescriptionType = 'Google_Service_Dataflow_PipelineDescription';
	protected $pipelineDescriptionDataType = '';
	protected $stageStatesType = 'Google_Service_Dataflow_ExecutionStageState';
	protected $stageStatesDataType = 'array';
	protected $stepsType = 'Google_Service_Dataflow_Step';
	protected $stepsDataType = 'array';
	
	public function getClientRequestId()
	{
		return $this->clientRequestId;
	}
	
	public function setClientRequestId($clientRequestId)
	{
		$this->clientRequestId = $clientRequestId;
	}
	
	public function getCreateTime()
	{
		return $this->createTime;
	}
	
	public function setCreateTime($createTime)
	{
		$this->createTime = $createTime;
	}
	
	public function getCurrentState()
	{
		return $this->currentState;
	}
	
	public function setCurrentState($currentState)
	{
		$this->currentState = $currentState;
	}
	
	public function getCurrentStateTime()
	{
		return $this->currentStateTime;
	}
	
	public function setCurrentStateTime($currentStateTime)
	{
		$this->currentStateTime = $currentStateTime;
	}
	
	/**
	 * @param Google_Service_Dataflow_Environment
	 */
	public function setEnvironment(Google_Service_Dataflow_Environment $environment)
	{
		$this->environment = $environment;
	}
	
	/**
	 * @return Google_Service_Dataflow_Environment
	 */
	public function getEnvironment()
	{
		return $this->environment;
	}
	
	/**
	 * @param Google_Service_Dataflow_JobExecutionInfo
	 */
	public function setExecutionInfo(Google_Service_Dataflow_JobExecutionInfo $executionInfo)
	{
		$this->executionInfo = $executionInfo;
	}
	
	/**
	 * @return Google_Service_Dataflow_JobExecutionInfo
	 */
	public function getExecutionInfo()
	{
		return $this->executionInfo;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getLabels()
	{
		return $this->labels;
	}
	
	public function setLabels($labels)
	{
		$this->labels = $labels;
	}
	
	public function getLocation()
	{
		return $this->location;
	}
	
	public function setLocation($location)
	{
		$this->location = $location;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	/**
	 * @param Google_Service_Dataflow_PipelineDescription
	 */
	public function setPipelineDescription(Google_Service_Dataflow_PipelineDescription $pipelineDescription)
	{
		$this->pipelineDescription = $pipelineDescription;
	}
	
	/**
	 * @return Google_Service_Dataflow_PipelineDescription
	 */
	public function getPipelineDescription()
	{
		return $this->pipelineDescription;
	}
	
	public function getProjectId()
	{
		return $this->projectId;
	}
	
	public function setProjectId($projectId)
	{
		$this->projectId = $projectId;
	}
	
	public function getReplaceJobId()
	{
		return $this->replaceJobId;
	}
	
	public function setReplaceJobId($replaceJobId)
	{
		$this->replaceJobId = $replaceJobId;
	}
	
	public function getReplacedByJobId()
	{
		return $this->replacedByJobId;
	}
	
	public function setReplacedByJobId($replacedByJobId)
	{
		$this->replacedByJobId = $replacedByJobId;
	}
	
	public function getRequestedState()
	{
		return $this->requestedState;
	}
	
	public function setRequestedState($requestedState)
	{
		$this->requestedState = $requestedState;
	}
	
	/**
	 * @param Google_Service_Dataflow_ExecutionStageState
	 */
	public function setStageStates($stageStates)
	{
		$this->stageStates = $stageStates;
	}
	
	/**
	 * @return Google_Service_Dataflow_ExecutionStageState
	 */
	public function getStageStates()
	{
		return $this->stageStates;
	}
	
	/**
	 * @param Google_Service_Dataflow_Step
	 */
	public function setSteps($steps)
	{
		$this->steps = $steps;
	}
	
	/**
	 * @return Google_Service_Dataflow_Step
	 */
	public function getSteps()
	{
		return $this->steps;
	}
	
	public function getTempFiles()
	{
		return $this->tempFiles;
	}
	
	public function setTempFiles($tempFiles)
	{
		$this->tempFiles = $tempFiles;
	}
	
	public function getTransformNameMapping()
	{
		return $this->transformNameMapping;
	}
	
	public function setTransformNameMapping($transformNameMapping)
	{
		$this->transformNameMapping = $transformNameMapping;
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function setType($type)
	{
		$this->type = $type;
	}
}
