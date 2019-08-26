<?php


namespace App\Service;


interface SmsInterface
{
    public function send(string $content): bool;
}