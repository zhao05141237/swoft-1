<?php declare(strict_types=1);


namespace App\Rpc\Lib;

/**
 * Class BrandInterface
 *
 * @since 2.0
 */
interface BrandInterface
{
    /**
     * @param int $brandId
     * @param string $brandName
     * @param int $count
     * @return array
     */
    public function getList(int $brandId = 0, string $brandName = '',int $count = 10): array;

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param array $attributes
     * @param array $values
     * @return bool
     */
    public function update(array $attributes, array $values = []):bool;

    /**
     * @param array $brandInfo
     * @return bool
     */
    public function insert(array $brandInfo):bool;
}