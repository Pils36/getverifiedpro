<?php

namespace GuzzleHttp\Subscriber;

use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Event\RequestEvents;
use GuzzleHttp\Event\SubscriberInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Message\MessageFactory;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Stream\StreamInterface;

/**
 * Queues mock responses or exceptions and delivers mock responses or
 * exceptions in a fifo order.
 */
class Mock implements SubscriberInterface, \Countable
{
	/** @var array Array of mock responses / exceptions */
	private $queue = [];
	
	/** @var bool Whether or not to consume an entity body when mocking */
	private $readBodies;
	
	/** @var MessageFactory */
	private $factory;
	
	/**
	 * @param array $items Array of responses or exceptions to queue
	 * @param bool $readBodies Set to false to not consume the entity body of
	 *                          a request when a mock is served.
	 */
	public function __construct(array $items = [], $readBodies = true)
	{
		$this->factory = new MessageFactory();
		$this->readBodies = $readBodies;
		$this->addMultiple($items);
	}
	
	/**
	 * Add multiple items to the queue
	 *
	 * @param array $items Items to add
	 */
	public function addMultiple(array $items)
	{
		foreach ($items as $item) {
			if ($item instanceof RequestException) {
				$this->addException($item);
			} else {
				$this->addResponse($item);
			}
		}
	}
	
	/**
	 * Add an exception to the end of the queue
	 *
	 * @param RequestException $e Exception to throw when the request is executed
	 *
	 * @return self
	 */
	public function addException(RequestException $e)
	{
		$this->queue[] = $e;
		
		return $this;
	}
	
	/**
	 * Add a response to the end of the queue
	 *
	 * @param string|ResponseInterface $response Response or path to response file
	 *
	 * @return self
	 * @throws \InvalidArgumentException if a string or Response is not passed
	 */
	public function addResponse($response)
	{
		if (is_string($response)) {
			$response = file_exists($response)
				? $this->factory->fromMessage(file_get_contents($response))
				: $this->factory->fromMessage($response);
		} elseif (!($response instanceof ResponseInterface)) {
			throw new \InvalidArgumentException('Response must a message '
				. 'string, response object, or path to a file');
		}
		
		$this->queue[] = $response;
		
		return $this;
	}
	
	public function getEvents()
	{
		// Fire the event last, after signing
		return ['before' => ['onBefore', RequestEvents::SIGN_REQUEST - 10]];
	}
	
	/**
	 * @throws \OutOfBoundsException|\Exception
	 */
	public function onBefore(BeforeEvent $event)
	{
		if (!$item = array_shift($this->queue)) {
			throw new \OutOfBoundsException('Mock queue is empty');
		} elseif ($item instanceof RequestException) {
			throw $item;
		}
		
		// Emulate reading a response body
		$request = $event->getRequest();
		if ($this->readBodies && $request->getBody()) {
			while (!$request->getBody()->eof()) {
				$request->getBody()->read(8096);
			}
		}
		
		$saveTo = $event->getRequest()->getConfig()->get('save_to');
		
		if (null !== $saveTo) {
			$body = $item->getBody();
			
			if (is_resource($saveTo)) {
				fwrite($saveTo, $body);
			} elseif (is_string($saveTo)) {
				file_put_contents($saveTo, $body);
			} elseif ($saveTo instanceof StreamInterface) {
				$saveTo->write($body);
			}
		}
		
		$event->intercept($item);
	}
	
	public function count()
	{
		return count($this->queue);
	}
	
	/**
	 * Clear the queue
	 */
	public function clearQueue()
	{
		$this->queue = [];
	}
}
