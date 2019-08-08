<?php


namespace App\Model\Dao;

use App\Model\Entity\BrandNewUpdate;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class BrandNewUpdateDao
 * @package App\Model\Dao
 * @Bean()
 */
class BrandNewUpdateDao
{
    public function getBrandListChuckById($size, \Closure $closure)
    {
        return BrandNewUpdate::chunkById($size,$closure);
    }

}