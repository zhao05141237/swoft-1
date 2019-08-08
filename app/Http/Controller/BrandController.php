<?php


namespace App\Http\Controller;

use App\Model\Data\BrandData;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Console\Helper\Show;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Log\Helper\CLog;
use Swoft\Log\Helper\Log;
use Swoft\Log\Logger;
use Swoft\Redis\Redis;

/**
 * Class BrandController
 * @package App\Http\Controller
 * @Controller()
 */
class BrandController
{
    /**
     * @Inject()
     * @var BrandData
     */
    private $brandData;


    /**
     * @RequestMapping()
     */
    public function cache()
    {
        $this->brandData->getBrandListChuckById(1000, function ($brandList) {
            sgo(function() use ($brandList){
                $redisList = [];
                foreach ($brandList as $key => $row) {
                    if (empty($row->getBrandName()) || empty($row->getBrandNameRaw())) {
                        continue;
                    }
//                    CLog::info('brandnameraw old:' . $row->getBrandNameRaw());
                    $this->brandData->formatSuperBrand($row);
                    $brandName = $this->brandData->getMd5BrandName($row);
//                    CLog::info("\tbrandnameraw new:" . $row->getBrandNameRaw() . "\tbrandnameraw md5:" . $brandName);

                    $cacheKey = "super:brand:" . $brandName;

                    $redisList[$cacheKey] = implode("###", [$row->getBrandId(), $row->getBrandName(), strtoupper($row->getBrandLevel())]);

//                    Redis::setex($cacheKey,365*24*3600,implode("###",[$row->getBrandId(),$row->getBrandName(),strtoupper($row->getBrandLevel())]));
                }

//                Log::profileStart('redis_set_ex');
                $result = Redis::pipeline(function (\Redis $redis) use ($redisList) {
                    foreach ($redisList as $index => $item) {
                        $redis->setex($index, 1, $item);
                    }
                });
//                Log::profileEnd('redis_set_ex');

//                foreach ($result as $index => $item) {
//                    if($item){
//                        Log::info($index.' success');
//                    }else{
//                        Log::info($index.' fail');
//                    }
//                }
            });


//            return false;
        });

        return ['success'];

    }

}