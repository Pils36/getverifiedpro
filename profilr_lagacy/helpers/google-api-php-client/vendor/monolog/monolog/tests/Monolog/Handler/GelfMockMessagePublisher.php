<?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Gelf\Message;
use Gelf\MessagePublisher;

class GelfMockMessagePublisher extends MessagePublisher
{
	public $lastMessage = null;
	
	public function publish(Message $message)
	{
		$this->lastMessage = $message;
	}
}
