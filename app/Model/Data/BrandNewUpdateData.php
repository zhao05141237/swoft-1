<?php


namespace App\Model\Data;

use App\Model\Dao\BrandNewUpdateDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class BrandNewUpdateData
 * @package App\Model\Data
 * @Bean()
 */
class BrandNewUpdateData
{
    /**
     * @Inject()
     * @var BrandNewUpdateDao
     */
    private $brandNewUpdateDao;


    public function getBrandListChuckById($size,\Closure $closure)
    {
        return $this->brandNewUpdateDao->getBrandListChuckById($size,$closure);

    }


}