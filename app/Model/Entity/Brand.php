<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;

/**
 *
 * Class Brand
 * @package App\Model\Entity
 * @Entity(table="brand_new",pool="db.pool.search.engine")
 */
class Brand extends Model
{
    /**
     * @Id()
     * @Column(name="id",prop="id")
     */
    private $id;

    /**
     * @Column(name="brand_id")
     * @var
     */
    private $brandId;

    /**
     * @Column(name="brand_name")
     * @var
     */
    private $brandName;

    /**
     * @Column(name="brandnameraw")
     * @var
     */
    private $brandNameRaw;

    /**
     * @Column(name="brand_level")
     * @var
     */
    private $brandLevel;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @param mixed $brandId
     */
    public function setBrandId($brandId): void
    {
        $this->brandId = $brandId;
    }

    /**
     * @return mixed
     */
    public function getBrandName()
    {
        return $this->brandName;
    }

    /**
     * @param mixed $brandName
     */
    public function setBrandName($brandName): void
    {
        $this->brandName = $brandName;
    }

    /**
     * @return mixed
     */
    public function getBrandNameRaw()
    {
        return $this->brandNameRaw;
    }

    /**
     * @param mixed $brandNameRaw
     */
    public function setBrandNameRaw($brandNameRaw): void
    {
        $this->brandNameRaw = $brandNameRaw;
    }

    /**
     * @return mixed
     */
    public function getBrandLevel()
    {
        return $this->brandLevel;
    }

    /**
     * @param mixed $brandLevel
     */
    public function setBrandLevel($brandLevel): void
    {
        $this->brandLevel = $brandLevel;
    }



}