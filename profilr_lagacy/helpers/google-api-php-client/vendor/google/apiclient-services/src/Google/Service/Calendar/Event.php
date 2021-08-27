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

class Google_Service_Calendar_Event extends Google_Collection
{
	public $anyoneCanAddSelf;
	public $attendeesOmitted;
	public $colorId;
	public $created;
	public $description;
	public $endTimeUnspecified;
	public $etag;
	public $guestsCanInviteOthers;
	public $guestsCanModify;
	public $guestsCanSeeOtherGuests;
	public $hangoutLink;
	public $htmlLink;
	public $iCalUID;
	public $id;
	public $kind;
	public $location;
	public $locked;
	public $privateCopy;
	public $recurrence;
	public $recurringEventId;
	public $sequence;
	public $status;
	public $summary;
	public $transparency;
	public $updated;
	public $visibility;
	protected $collection_key = 'recurrence';
	protected $attachmentsType = 'Google_Service_Calendar_EventAttachment';
	protected $attachmentsDataType = 'array';
	protected $attendeesType = 'Google_Service_Calendar_EventAttendee';
	protected $attendeesDataType = 'array';
	protected $creatorType = 'Google_Service_Calendar_EventCreator';
	protected $creatorDataType = '';
	protected $endType = 'Google_Service_Calendar_EventDateTime';
	protected $endDataType = '';
	protected $extendedPropertiesType = 'Google_Service_Calendar_EventExtendedProperties';
	protected $extendedPropertiesDataType = '';
	protected $gadgetType = 'Google_Service_Calendar_EventGadget';
	protected $gadgetDataType = '';
	protected $organizerType = 'Google_Service_Calendar_EventOrganizer';
	protected $organizerDataType = '';
	protected $originalStartTimeType = 'Google_Service_Calendar_EventDateTime';
	protected $originalStartTimeDataType = '';
	protected $remindersType = 'Google_Service_Calendar_EventReminders';
	protected $remindersDataType = '';
	protected $sourceType = 'Google_Service_Calendar_EventSource';
	protected $sourceDataType = '';
	protected $startType = 'Google_Service_Calendar_EventDateTime';
	protected $startDataType = '';
	
	public function getAnyoneCanAddSelf()
	{
		return $this->anyoneCanAddSelf;
	}
	
	public function setAnyoneCanAddSelf($anyoneCanAddSelf)
	{
		$this->anyoneCanAddSelf = $anyoneCanAddSelf;
	}
	
	/**
	 * @param Google_Service_Calendar_EventAttachment
	 */
	public function setAttachments($attachments)
	{
		$this->attachments = $attachments;
	}
	
	/**
	 * @return Google_Service_Calendar_EventAttachment
	 */
	public function getAttachments()
	{
		return $this->attachments;
	}
	
	/**
	 * @param Google_Service_Calendar_EventAttendee
	 */
	public function setAttendees($attendees)
	{
		$this->attendees = $attendees;
	}
	
	/**
	 * @return Google_Service_Calendar_EventAttendee
	 */
	public function getAttendees()
	{
		return $this->attendees;
	}
	
	public function getAttendeesOmitted()
	{
		return $this->attendeesOmitted;
	}
	
	public function setAttendeesOmitted($attendeesOmitted)
	{
		$this->attendeesOmitted = $attendeesOmitted;
	}
	
	public function getColorId()
	{
		return $this->colorId;
	}
	
	public function setColorId($colorId)
	{
		$this->colorId = $colorId;
	}
	
	public function getCreated()
	{
		return $this->created;
	}
	
	public function setCreated($created)
	{
		$this->created = $created;
	}
	
	/**
	 * @param Google_Service_Calendar_EventCreator
	 */
	public function setCreator(Google_Service_Calendar_EventCreator $creator)
	{
		$this->creator = $creator;
	}
	
	/**
	 * @return Google_Service_Calendar_EventCreator
	 */
	public function getCreator()
	{
		return $this->creator;
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
	 * @param Google_Service_Calendar_EventDateTime
	 */
	public function setEnd(Google_Service_Calendar_EventDateTime $end)
	{
		$this->end = $end;
	}
	
	/**
	 * @return Google_Service_Calendar_EventDateTime
	 */
	public function getEnd()
	{
		return $this->end;
	}
	
	public function getEndTimeUnspecified()
	{
		return $this->endTimeUnspecified;
	}
	
	public function setEndTimeUnspecified($endTimeUnspecified)
	{
		$this->endTimeUnspecified = $endTimeUnspecified;
	}
	
	public function getEtag()
	{
		return $this->etag;
	}
	
	public function setEtag($etag)
	{
		$this->etag = $etag;
	}
	
	/**
	 * @param Google_Service_Calendar_EventExtendedProperties
	 */
	public function setExtendedProperties(Google_Service_Calendar_EventExtendedProperties $extendedProperties)
	{
		$this->extendedProperties = $extendedProperties;
	}
	
	/**
	 * @return Google_Service_Calendar_EventExtendedProperties
	 */
	public function getExtendedProperties()
	{
		return $this->extendedProperties;
	}
	
	/**
	 * @param Google_Service_Calendar_EventGadget
	 */
	public function setGadget(Google_Service_Calendar_EventGadget $gadget)
	{
		$this->gadget = $gadget;
	}
	
	/**
	 * @return Google_Service_Calendar_EventGadget
	 */
	public function getGadget()
	{
		return $this->gadget;
	}
	
	public function getGuestsCanInviteOthers()
	{
		return $this->guestsCanInviteOthers;
	}
	
	public function setGuestsCanInviteOthers($guestsCanInviteOthers)
	{
		$this->guestsCanInviteOthers = $guestsCanInviteOthers;
	}
	
	public function getGuestsCanModify()
	{
		return $this->guestsCanModify;
	}
	
	public function setGuestsCanModify($guestsCanModify)
	{
		$this->guestsCanModify = $guestsCanModify;
	}
	
	public function getGuestsCanSeeOtherGuests()
	{
		return $this->guestsCanSeeOtherGuests;
	}
	
	public function setGuestsCanSeeOtherGuests($guestsCanSeeOtherGuests)
	{
		$this->guestsCanSeeOtherGuests = $guestsCanSeeOtherGuests;
	}
	
	public function getHangoutLink()
	{
		return $this->hangoutLink;
	}
	
	public function setHangoutLink($hangoutLink)
	{
		$this->hangoutLink = $hangoutLink;
	}
	
	public function getHtmlLink()
	{
		return $this->htmlLink;
	}
	
	public function setHtmlLink($htmlLink)
	{
		$this->htmlLink = $htmlLink;
	}
	
	public function getICalUID()
	{
		return $this->iCalUID;
	}
	
	public function setICalUID($iCalUID)
	{
		$this->iCalUID = $iCalUID;
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
	
	public function getLocation()
	{
		return $this->location;
	}
	
	public function setLocation($location)
	{
		$this->location = $location;
	}
	
	public function getLocked()
	{
		return $this->locked;
	}
	
	public function setLocked($locked)
	{
		$this->locked = $locked;
	}
	
	/**
	 * @param Google_Service_Calendar_EventOrganizer
	 */
	public function setOrganizer(Google_Service_Calendar_EventOrganizer $organizer)
	{
		$this->organizer = $organizer;
	}
	
	/**
	 * @return Google_Service_Calendar_EventOrganizer
	 */
	public function getOrganizer()
	{
		return $this->organizer;
	}
	
	/**
	 * @param Google_Service_Calendar_EventDateTime
	 */
	public function setOriginalStartTime(Google_Service_Calendar_EventDateTime $originalStartTime)
	{
		$this->originalStartTime = $originalStartTime;
	}
	
	/**
	 * @return Google_Service_Calendar_EventDateTime
	 */
	public function getOriginalStartTime()
	{
		return $this->originalStartTime;
	}
	
	public function getPrivateCopy()
	{
		return $this->privateCopy;
	}
	
	public function setPrivateCopy($privateCopy)
	{
		$this->privateCopy = $privateCopy;
	}
	
	public function getRecurrence()
	{
		return $this->recurrence;
	}
	
	public function setRecurrence($recurrence)
	{
		$this->recurrence = $recurrence;
	}
	
	public function getRecurringEventId()
	{
		return $this->recurringEventId;
	}
	
	public function setRecurringEventId($recurringEventId)
	{
		$this->recurringEventId = $recurringEventId;
	}
	
	/**
	 * @param Google_Service_Calendar_EventReminders
	 */
	public function setReminders(Google_Service_Calendar_EventReminders $reminders)
	{
		$this->reminders = $reminders;
	}
	
	/**
	 * @return Google_Service_Calendar_EventReminders
	 */
	public function getReminders()
	{
		return $this->reminders;
	}
	
	public function getSequence()
	{
		return $this->sequence;
	}
	
	public function setSequence($sequence)
	{
		$this->sequence = $sequence;
	}
	
	/**
	 * @param Google_Service_Calendar_EventSource
	 */
	public function setSource(Google_Service_Calendar_EventSource $source)
	{
		$this->source = $source;
	}
	
	/**
	 * @return Google_Service_Calendar_EventSource
	 */
	public function getSource()
	{
		return $this->source;
	}
	
	/**
	 * @param Google_Service_Calendar_EventDateTime
	 */
	public function setStart(Google_Service_Calendar_EventDateTime $start)
	{
		$this->start = $start;
	}
	
	/**
	 * @return Google_Service_Calendar_EventDateTime
	 */
	public function getStart()
	{
		return $this->start;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function setStatus($status)
	{
		$this->status = $status;
	}
	
	public function getSummary()
	{
		return $this->summary;
	}
	
	public function setSummary($summary)
	{
		$this->summary = $summary;
	}
	
	public function getTransparency()
	{
		return $this->transparency;
	}
	
	public function setTransparency($transparency)
	{
		$this->transparency = $transparency;
	}
	
	public function getUpdated()
	{
		return $this->updated;
	}
	
	public function setUpdated($updated)
	{
		$this->updated = $updated;
	}
	
	public function getVisibility()
	{
		return $this->visibility;
	}
	
	public function setVisibility($visibility)
	{
		$this->visibility = $visibility;
	}
}
