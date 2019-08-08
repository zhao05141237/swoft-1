<?php


namespace App\Model\Dao;

use App\Model\Entity\Post;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class PostDao
 * @package App\Model\Dao
 * @Bean()
 */
class PostDao
{

    public function getList()
    {
        return Post::get()->take(10)->toArray();

    }

}