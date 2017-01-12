<?php

namespace XM\MailerTestBundle\EmailListener;

/**
 * Class SwiftEmailListener
 * Helps with email testing.
 * This is taken from
 * http://sgoettschkes.blogspot.ca/2012/09/symfony2-testing-email-sending.html
 */
class SwiftEmailListener implements \Swift_Events_SendListener
{
    /**
     * @var \Swift_Events_SendEvent
     */
    protected $beforeSendEvent = null;

    /**
     * @var \Swift_Events_SendEvent
     */
    protected $sendEvent = null;

    /**
     * Stores the event as the before send event.
     *
     * @param \Swift_Events_SendEvent $event
     */
    public function beforeSendPerformed(\Swift_Events_SendEvent $event)
    {
        $this->beforeSendEvent = $event;
    }

    /**
     * Stores the event as the send event.
     *
     * @param \Swift_Events_SendEvent $event
     */
    public function sendPerformed(\Swift_Events_SendEvent $event)
    {
        $this->sendEvent = $event;
    }

    /**
     * Retrieves the before send event.
     *
     * @return \Swift_Events_SendEvent
     */
    public function getBeforeSendEvent()
    {
        return $this->beforeSendEvent;
    }

    /**
     * Retrieves the send event.
     *
     * @return \Swift_Events_SendEvent
     */
    public function getSendEvent()
    {
        return $this->sendEvent;
    }
}