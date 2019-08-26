<?php


namespace App\Service\Impl\Sms;


use App\Service\SmsInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class Sms
 * @package App\Service\Impl\Sms
 * @Bean()
 */
class Sms implements SmsInterface
{
    /**
     * @Inject(QcloudSms::class)
     * @var SmsInterface
     */
    private $smsInterface;

    /**
     * @param string $content
     * @return bool
     */
    public function send(string $content): bool
    {
        // TODO: Implement send() method.
        return $this->smsInterface->send($content);
    }


}