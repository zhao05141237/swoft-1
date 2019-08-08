<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 *  品牌补充更新表
 * Class BrandNewUpdate
 *
 * @since 2.0
 *
 * @Entity(table="brand_new_update",pool="db.pool.search.engine")
 */
class BrandNewUpdate extends Model
{
    /**
     * 自增id
     * @Id()
     * @Column()
     * @var int|null
     */
    private $id;

    /**
     * 品牌id
     *
     * @Column(name="brand_id",prop="brandId")
     * @var int
     */
    private $brandId;

    /**
     * 品牌名
     *
     * @Column(name="brand_name",prop="brandName")
     * @var string|null
     */
    private $brandName;


    /**
     * @param int|null $id
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param int $brandId
     * @return self
     */
    public function setBrandId(int $brandId): self
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * @param string|null $brandName
     * @return self
     */
    public function setBrandName(?string $brandName): self
    {
        $this->brandName = $brandName;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @return string|null
     */
    public function getBrandName()
    {
        return $this->brandName;
    }

}
