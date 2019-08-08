<?php


namespace App\Model\Data;

use App\Model\Dao\BrandDao;
use App\Model\Entity\Brand;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class BrandData
 * @package App\Model\Data
 * @Bean()
 */
class BrandData
{
    /**
     * @Inject()
     * @var BrandDao
     */
    private $brandDao;

    public function getBrandList()
    {
        return $this->brandDao->getBrandList();
    }

    public function getBrandListChuckById($size,\Closure $closure)
    {
        return $this->brandDao->getBrandListChuckById($size,$closure);

    }

    public function formatSuperBrand(Brand $brand)
    {
        if(!empty($brand->getBrandNameRaw())){
            $name = str_replace("（","(",$brand->getBrandNameRaw());
            $name = str_replace("）",")",$name);
            $name = str_replace(" ","",$name);
            $name = strtolower($name);
            $brand->setBrandNameRaw($name);
        }
    }

    public function formatSuperBrandAgain(Brand $brand){
        if(!empty($brand->getBrandNameRaw()) && strpos($brand->getBrandNameRaw(),"(") !== false){
            $name = explode("(",$brand->getBrandNameRaw());
            $brand->setBrandNameRaw($name[0]);
        }
    }

    public function getMd5BrandName(Brand $brand)
    {
        return substr(md5($brand->getBrandNameRaw()), 0, 16);
    }

}