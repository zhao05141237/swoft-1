<?php


namespace App\Service\Impl\Sms;


use App\Service\SmsInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Log\Helper\CLog;

/**
 * Class QcloudSms
 * @package App\Service\Impl\Sms
 * @Bean()
 */
class QcloudSms implements SmsInterface
{
    public function send(string $content): bool
    {
        // TODO: Implement send() method.
        CLog::info(__METHOD__.$content);
        return true;
    }


}