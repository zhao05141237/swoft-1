<?php


namespace App\Http\Controller;

use App\Rpc\Lib\PostInterface;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Rpc\Client\Annotation\Mapping\Reference;

/**
 * Class RpcPostController
 * @package App\Http\Controller
 * @Controller()
 */
class RpcPostController
{
    /**
     * @Reference(pool="user.pool")
     * @var PostInterface
     */
    private $postService;

    /**
     * @RequestMapping("getList")
     * @return array|mixed
     */
    public function getList()
    {
        return $this->postService->getList();
    }

}