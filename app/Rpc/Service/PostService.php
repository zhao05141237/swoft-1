<?php


namespace App\Rpc\Service;

use App\Model\Data\PostData;
use App\Rpc\Lib\PostInterface;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class PostService
 * @package App\Rpc\Service
 * @Service()
 */
class PostService implements PostInterface
{
    /**
     * @Inject()
     * @var PostData
     */
    protected $postData;


    public function getList()
    {
        // TODO: Implement getList() method.
        return $this->postData->getList();
    }


}