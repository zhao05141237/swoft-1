<?php


namespace App\Rpc\Service;


use App\Model\Entity\TbBrandNew;
use App\Rpc\Lib\BrandInterface;
use ReflectionException;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Db\Exception\DbException;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class BrandService
 * @package App\Rpc\Service
 * @Service()
 */
class BrandService implements BrandInterface
{
    /**
     * @param int $brandId
     * @param string $brandName
     * @param int $count
     * @return array
     * @throws ReflectionException
     * @throws ContainerException
     * @throws DbException
     */
    public function getList(int $brandId = 0, string $brandName = '', int $count = 10): array
    {
        // TODO: Implement getList() method.
        if (!empty($brandId)) {
            return TbBrandNew::where('brand_id', $brandId)->take($count)->get()->toArray();
        }

        if (!empty($brandName)) {
            return TbBrandNew::where('brand_name', 'like', $brandName . '%')->take($count)->get()->toArray();
        }

        return TbBrandNew::take($count)->get()->toArray();
    }

    /**
     * @param int $id
     * @return bool
     * @throws ReflectionException
     * @throws ContainerException
     * @throws DbException
     */
    public function delete(int $id): bool
    {
        $brand = TbBrandNew::find($id);
        if ($brand) {
            return $brand->delete();
        }
        return false;
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return bool
     */
    public function update(array $attributes, array $values = []): bool
    {
        // TODO: Implement update() method.
        return TbBrandNew::updateOrInsert($attributes, $values);

    }

    /**
     * @param array $brandInfo
     * @return bool
     */
    public function insert(array $brandInfo): bool
    {
        // TODO: Implement insert() method.
        return TbBrandNew::insert($brandInfo);
    }


}