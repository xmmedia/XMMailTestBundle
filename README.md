# XMMailerTestBundle
Allows for easy testing of the mailer/emails when using the [SwiftMailerBundle](/symfony/swiftmailer-bundle).

## Installation

### Step 1: Download the Bundle

**This package is not on Packagist, so the repository will need to be added manually in composer.json**

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ php composer.phar require --dev xm/mailer-test-bundle
```

This command requires [Composer](https://getcomposer.org/download/).

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        // ...
        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            // ...
            $bundles[] = new XM\MailerTestBundle\XMMailerTestBundle();
        }
    }
}
```

## Usage

Below is how this bundle would be typically used.

```php
<?php

namespace Tests\AppBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\GenericEvent;
use XM\MailerTestBundle\Test\MailerTestCase;

class EventSubscriberTest extends MailerTestCase
{
    public function testEvent()
    {
        $mailerPlugin = $this->getMailerPlugin();

        $event = new GenericEvent();

        $this->container->get('app.listener')
            ->onEvent($event);

        // make sure email was sent
        $this->assertNotNull($mailerPlugin->beforeSendEvent);
        $this->assertNotNull($mailerPlugin->sendEvent);

        // grab message and make sure it matches what we wanted
        $msg = $mailerPlugin->sendEvent->getMessage();

        $expected = 'Expected Subject';
        $this->assertEquals($expected, $msg->getSubject());

        $this->assertContains('Expected part of email body', $msg->getBody());
    }
}
```