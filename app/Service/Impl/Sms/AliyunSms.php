<?php


namespace App\Service\Impl\Sms;


use App\Service\SmsInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Primary;
use Swoft\Log\Helper\CLog;

/**
 * @Bean()
 * @Primary()
 * Class AliyunSms
 * @package App\Service\Impl\Sms
 */
class AliyunSms implements SmsInterface
{
    /**
     * @param string $content
     * @return bool
     */
    public function send(string $content): bool
    {
        // TODO: Implement send() method.
        CLog::info(__CLASS__.__FUNCTION__.$content);
        return true;
    }


}