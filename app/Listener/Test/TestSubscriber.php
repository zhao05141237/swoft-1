<?php


namespace App\Listener\Test;


use Swoft\Event\Annotation\Mapping\Subscriber;
use Swoft\Event\EventInterface;
use Swoft\Event\EventSubscriberInterface;
use Swoft\Log\Helper\CLog;

/**
 * Class TestSubscriber
 * @package App\Listener\Test
 * @Subscriber()
 */
class TestSubscriber implements EventSubscriberInterface
{
    public const EVENT_ONE = 'test.event1';
    public const EVENT_TWO = 'test.event2';

    public static function getSubscribedEvents(): array
    {
        // TODO: Implement getSubscribedEvents() method.
        return [
            self::EVENT_ONE => 'handleEvent',
            self::EVENT_TWO => 'handleEvent',
        ];
    }

    public function handleEvent(EventInterface $event) : void
    {
//        $event->setParams(['msg' => 'handle the event: test.event1 position: TestSubscriber.handleEvent1()']);
        $pos = __METHOD__;
        // TODO: Implement handle() method.
        CLog::info("handle the event {$event->getName()} on the {$pos}");
    }

}