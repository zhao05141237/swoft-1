<?php


namespace App\Http\Controller;

use App\Application;
use App\Http\Middleware\ControllerMiddleware;
use App\Model\Dao\UserDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\BeanFactory;
use Swoft\Db\DB;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;


/**
 * Class DemoController
 * @package App\Http\Controller
 * @Controller("aa")
 */
class DemoController
{
    protected $count = 0;


    /**
     * @RequestMapping(route="index")
     * @RequestMapping(method={RequestMethod::POST})
     * @Middleware(ControllerMiddleware::class)
     * @return array
     */
    public function index()
    {
//        $httpServer = BeanFactory::getSingleton("httpServer");
//        $aa = BeanFactory::getBean('UserDao');
////        return [$this->count++];
//        return [$httpServer->getSwooleServer()->worker_pid,$this->count++,$aa->count++];
        $stat = \server()->getSwooleStats();
        return [$stat,$this->count++];
    }

}

