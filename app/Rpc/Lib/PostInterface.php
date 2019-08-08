<?php
declare(strict_types=1);


namespace App\Rpc\Lib;

/**
 * Interface PostInterface
 * @package App\Rpc\Lib
 */
interface PostInterface
{
    /**
     * @return mixed
     */
    public function getList();
}