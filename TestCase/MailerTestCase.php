<?php

namespace XM\MailerTestBundle\TestCase;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use XM\MailerTestBundle\EmailListener\SwiftEmailListener;

/**
 * Class MailTestCase
 *
 * @package XM\MailerTestBundle
 */
class MailerTestCase extends KernelTestCase
{
    /**
     * Registers the email listener plugin with the mailer (Swift).
     *
     * @return SwiftEmailListener
     */
    protected function getMailerPlugin()
    {
        $plugin = new SwiftEmailListener();
        $this->getMailer()->registerPlugin($plugin);

        return $plugin;
    }

    /**
     * Retrieves the mailer, typically from the container.
     *
     * @return object
     */
    protected function getMailer()
    {
        return static::$kernel->getContainer()->get('mailer');
    }
}