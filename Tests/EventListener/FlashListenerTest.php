<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\UserBundle\Tests\EventListener;

use FOS\UserBundle\EventListener\FlashListener;
use FOS\UserBundle\FOSUserEvents;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Contracts\Translation\TranslatorInterface;

class FlashListenerTest extends TestCase
{
    private Event $event;
    private FlashListener $listener;

    protected function setUp(): void
    {
        $this->event = new Event();

        $flashBag = $this->getMockBuilder(FlashBag::class)->getMock();

        $session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();
        $session
            ->expects(self::once())
            ->method('getFlashBag')
            ->willReturn($flashBag);

        $translator = $this->getMockBuilder(TranslatorInterface::class)->getMock();

        $this->listener = new FlashListener($session, $translator);
    }

    public function testAddSuccessFlash(): void
    {
        $this->listener->addSuccessFlash($this->event, FOSUserEvents::CHANGE_PASSWORD_COMPLETED);
    }
}
