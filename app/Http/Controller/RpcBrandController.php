<?php


namespace App\Http\Controller;

use App\Rpc\Lib\BrandInterface;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Rpc\Client\Annotation\Mapping\Reference;

/**
 * Class RpcBrandController
 * @package App\Http\Controller
 * @Controller()
 */
class RpcBrandController
{

    /**
     * @Reference(pool="user.pool")
     * @var BrandInterface
     */
    private $brandService;

    /**
     * @RequestMapping("list/{brandId}[/{brandName}]")
     * @param int $brandId
     * @param string $brandName
     * @return array
     */
    public function list(int $brandId = 0,string $brandName = "")
    {
        return $this->brandService->getList($brandId,$brandName);
    }

    /**
     * @RequestMapping("del/{id}")
     * @param int $id
     * @return string
     */
    public function delete(int $id = 0)
    {
        return (string) $this->brandService->delete($id);
    }

}