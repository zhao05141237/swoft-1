<?php


namespace App\Model\Dao;

use App\Model\Entity\Brand;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class BrandDao
 * @package App\Model\Dao
 * @Bean()
 */
class BrandDao
{
    public function getBrandList()
    {
        return Brand::get()->take(10)->toArray();
    }

    public function getBrandListChuckById($size,\Closure $closure)
    {
        return Brand::chunkById($size,$closure);
    }



}