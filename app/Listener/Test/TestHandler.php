<?php


namespace App\Listener\Test;

use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\Log\Helper\CLog;

/**
 * @Listener("test.evt")
 * Class TestHandler
 * @package App\Listener\Test
 */
class TestHandler implements EventHandlerInterface
{
    public function handle(EventInterface $event): void
    {
        $pos = __METHOD__;
        // TODO: Implement handle() method.
        CLog::info("handle the event {$event->getName()} on the {$pos}");

    }


}