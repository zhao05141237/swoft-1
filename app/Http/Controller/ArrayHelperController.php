<?php


namespace App\Http\Controller;

use App\Model\Entity\Users;
use stdClass;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Stdlib\Helper\ArrayHelper;

/**
 * Class ArrayHelperController
 * @package App\Http\Controller
 * @Controller()
 */
class ArrayHelperController
{

    /**
     * @RequestMapping()
     */
    public function toArray()
    {
//        $objSub = new stdClass();
//        $objSub->version = '2.0.6';
//        $objSub->url = 'https://www.swoft.org';
//
//        $obj = new stdClass();
//        $obj->name = 'swoft framework 2.x';
//        $obj->desc = $objSub;
//
//        return [
//            ArrayHelper::toArray($obj),
//            ArrayHelper::toArray($obj, [get_class($obj) => ['name']]),
//            ArrayHelper::toArray($obj, [], false)
//        ];

        return ArrayHelper::toArray(Users::find(1));
    }

}