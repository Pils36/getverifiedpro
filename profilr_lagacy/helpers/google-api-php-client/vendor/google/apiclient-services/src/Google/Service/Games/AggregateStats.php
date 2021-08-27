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

class Google_Service_Games_AggregateStats extends Google_Model
{
	public $count;
	public $kind;
	public $max;
	public $min;
	public $sum;
	
	public function getCount()
	{
		return $this->count;
	}
	
	public function setCount($count)
	{
		$this->count = $count;
	}
	
	public function getKind()
	{
		return $this->kind;
	}
	
	public function setKind($kind)
	{
		$this->kind = $kind;
	}
	
	public function getMax()
	{
		return $this->max;
	}
	
	public function setMax($max)
	{
		$this->max = $max;
	}
	
	public function getMin()
	{
		return $this->min;
	}
	
	public function setMin($min)
	{
		$this->min = $min;
	}
	
	public function getSum()
	{
		return $this->sum;
	}
	
	public function setSum($sum)
	{
		$this->sum = $sum;
	}
}