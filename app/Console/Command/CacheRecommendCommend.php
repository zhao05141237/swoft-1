<?php


namespace App\Console\Command;

use App\Model\Data\BrandData;
use App\Model\Data\BrandNewUpdateData;
use Exception;
use function foo\func;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Co;
use Swoft\Console\Annotation\Mapping\Command;
use Swoft\Console\Annotation\Mapping\CommandMapping;
use Swoft\Console\Helper\Show;
use Swoft\Console\Input\Input;
use Swoft\Log\Helper\CLog;
use Swoft\Log\Helper\Log;
use Swoft\Redis\Redis;
use Swoole\Coroutine;
use Swoole\Coroutine\Http\Client;

/**
 * test cache recommend use coroutine
 * @package App\Console\Command
 * @Command(name="cache",coroutine=true)
 */
class CacheRecommendCommend
{
    /**
     * @Inject()
     * @var BrandData
     */
    private $brandData;

    /**
     * @Inject()
     * @var BrandNewUpdateData
     */
    private $brandNewUpdateData;

    /**
     * @CommandMapping()
     * @param Input $input
     */
    public function test(Input $input): void
    {
        Show::prettyJSON([
            'args' => $input->getArgs(),
            'opts' => $input->getOptions(),
        ]);
    }

    /**
     * @CommandMapping()
     * @param Input $input
     */
    public function recommend(Input $input): void
    {
        $keyword = $input->get('keyword');
        $uid = $input->get('uid');

        if (empty($keyword) || empty($uid)) {
            Show::info('uid keyword must key');
            return;
        }

        $group = range('a', 'f');
        $requests = [];
        foreach ($group as $key => $val) {
            $requests[$val] = function () use ($val, $keyword, $uid) {
                $cli = new Client('cache.recommend.51fanli.it', 80);
                $path = '/recom/app/search?keyword=' . urlencode($keyword) . '&page=1&page_size=2&order=complex&uid=' . $uid . '&abtest=' . $val;
                Show::info($path);
                $cli->get($path);
                $result = $cli->body;
                $result = json_decode($result, true);
                $cli->close();
                return $result;
            };
        }

        try {
            $response = Co::multi($requests);
            Show::prettyJSON(array_values($response));
        } catch (Exception $exception) {
            Show::info($exception->getMessage());
        }
    }

    /**
     * @CommandMapping()
     */
    public function cacheBrand()
    {
        $this->brandData->getBrandListChuckById(20000, function ($brandList) {
            $redisList = [];
            foreach ($brandList as $key => $row) {
                if (empty($row->getBrandName()) || empty($row->getBrandNameRaw())) {
                    continue;
                }
                echo 'brandnameraw old:' . $row->getBrandNameRaw();
                $this->brandData->formatSuperBrand($row);
                $brandName = $this->brandData->getMd5BrandName($row);
                echo "\tbrandnameraw new:" . $row->getBrandNameRaw() . "\tbrandnameraw md5:" . $brandName . PHP_EOL;

                $cacheKey = "super:brand:" . $brandName;

                $redisList[$cacheKey] = implode("###", [$row->getBrandId(), $row->getBrandName(), strtoupper($row->getBrandLevel())]);

//                    Redis::setex($cacheKey,365*24*3600,implode("###",[$row->getBrandId(),$row->getBrandName(),strtoupper($row->getBrandLevel())]));
            }

            $result = Redis::pipeline(function (\Redis $redis) use ($redisList) {
                foreach ($redisList as $index => $item) {
                    $redis->setex($index, 365 * 24 * 3600, $item);
                }
            });

            foreach ($result as $index => $item) {
                if($item){
                    Show::info($index.' success');
                }else{
                    Show::info($index.' fail');
                }
            }

            return false;
        });

//        go(function (){
//           Show::prettyJSON(Coroutine::stats());
//        });
//        Show::prettyJSON($this->brandData->getBrandList());
    }


    /**
     *
     * @CommandMapping()
     */
    public function addBrand()
    {
        $brandIdList = [];
        $this->brandData->getBrandListChuckById(20000, function ($brandList) use (&$brandIdList){
            foreach ($brandList as $key => $row) {
                if (empty($row->getBrandId())) {
                    continue;
                }
                $brandIdList[] = $row->getBrandId();
            }
        });
        $brandIdList = array_unique($brandIdList);
        Show::info('count brad id old list is:'.count($brandIdList));

        $this->brandNewUpdateData->getBrandListChuckById(20000,function($brandList) use (&$insertSql,$brandIdList){
            foreach ($brandList as $key => $row){
                $insertSql = "INSERT INTO tb_brand_new (brand_id,brand_name,brandnameraw) VALUES ";
                if(!in_array($row->getBrandId(),$brandIdList)){
                    $insertSql .= "(".$row->getBrandId().","."'".$row->getBrandName()."','".$row->getBrandName()."'),";
                    $insertSql = trim($insertSql,",");
                    echo $insertSql.";".PHP_EOL;
                }
            }
        });
    }


    /**
     * @CommandMapping()
     */
    public function cacheScripts()
    {
        $content = Co::readFile(__DIR__.'/CacheShortKeywordItems.log');
        $content = array_chunk(explode(PHP_EOL,$content),1000);
        foreach ($content as $key => $splitContent){
            sgo(function() use ($splitContent){
                Log::info(Co::id().'\t'.Co::tid().'\t');
                $redisKey = [];
                foreach ($splitContent as $key => $val) {
                    $val = trim($val);
                    $split = "#keywordresultis#";
                    $explodVal = explode($split, $val);
//                    Show::info(json_encode($explodVal));
                    if(!empty($explodVal) && isset($explodVal[0]) && isset($explodVal[1])){
                        $keyword = $this->getRedisKey($explodVal[0]);
                        $cacheKey = 'recom:short:word:hot:52702:new:key:'.$keyword;
                        $redisKey[$cacheKey] = $explodVal[1];
                    }
                }
                if(!empty($redisKey)){
                    Log::profileStart('tag');
                    Redis::pipeline(function(\Redis $redis) use ($redisKey){
                       foreach ($redisKey as $key => $val){
                           $redis->setex($key,1,$val);
                       }
                    });
                    Log::profileEnd('tag');
                }
            });
        }
    }

    protected function getRedisKey($val){
        return substr(md5($val),0,16);
    }


}