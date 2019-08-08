<?php


namespace App\Model\Data;

use App\Model\Dao\PostDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class PostData
 * @package App\Model\Data
 * @Bean()
 */
class PostData
{
    /**
     * @Inject()
     * @var PostDao
     */
    protected $postDao;

    public function getList()
    {
        return $this->postDao->getList();
    }

}