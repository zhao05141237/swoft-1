<?php declare(strict_types=1);


namespace App\Http\Controller;

use App\Model\Entity\User;
use Exception;
use Swoft\Co;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Redis\Redis;
use Swoole\Coroutine\Http\Client;
use Throwable;

/**
 * Class CoController
 *
 * @since 2.0
 *
 * @Controller()
 */
class CoController
{
    /**
     * @RequestMapping()
     *
     * @return array
     *
     * @throws Exception
     */
    public function multi(): array
    {
        $requests = [
            'addUser' => [$this, 'addUser'],
            'getUser' => "App\Http\Controller\CoController::getUser",
            'curl'    => function () {
                $cli = new Client('127.0.0.1', 18306);
                $cli->get('/redis/str');
                $result = $cli->body;
                $cli->close();

                return $result;
            }
        ];

        $response = Co::multi($requests);

        return $response;
    }

    /**
     * @RequestMapping()
     * @return array
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     */
    public function userProfile()
    {
        $userIdList = [22,7846,16295,89842,244380,262529,298934,368317,550310,614912,687224,881983,897183,1393104,1563965,1639131,1697562,1711403,1723555,1734124,1999950,2061557,2081205,2196895,2284238,2368988,2615189,2801202,2865858,3112970,3383274,3905982,4153461,4255770,4464880,4720311,5441560,5577132,5921389,6162633,6236117,6449295,6461504,6663128,6798630,7280656,7639593,7672549,8427998,8673214,8716352,8938046,9173682,9348074,9642472,9840007,10871453,11223518,11305673,11360813,11607062,12565772,13224930,13428263,13755154,13764075,14068604,15691208,16006260,16604910,17206825,17573253,18142143,18581898,19749182,19909460,20691862,20714344,20961817,21211518,22148056,23007690,23360721,23627896,25292988,25369062,25928669,26045948,26571986,26972370,27000928,27330831,30383568,30970829,31087576,32532513,33029895,33871990,35053395,36592799];

        $request = [];
        foreach ($userIdList as $index => $item) {
            $request[] = function() use ($item){
                return json_decode(file_get_contents("http://cache.recommend.51fanli.it/recom/hbase/getUserProfile?uid={$item}"),true);
            };
        }

        return Co::multi($request);


    }

    /**
     * @return array
     */
    public static function getUser(): array
    {
        $result = Redis::set('key', 'value');

        return [$result, Redis::get('key')];
    }

    /**
     * @return array
     * @throws Throwable
     */
    public function addUser(): array
    {
        $user = User::new();
        $user->setAge(mt_rand(1, 100));
        $user->setUserDesc('desc');

        // Save result
        $result = $user->save();

        return [$result, $user->getId()];
    }
}