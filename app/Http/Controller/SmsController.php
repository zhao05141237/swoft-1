<?php


namespace App\Http\Controller;

use App\Service\Impl\Sms\Sms;
use Swoft\Bean\BeanFactory;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * Class SmsController
 * @package App\Http\Controller
 * @Controller()
 */
class SmsController
{
    /**
     * @param string $content
     * @return bool
     * @RequestMapping("send/{content}")
     */
    public function send(string $content)
    {
        $sms = BeanFactory::getBean(Sms::class);
        \Swoft::trigger('test.event1');
        \Swoft::trigger('test.event2');
        return $sms->send($content);
        
    }

}