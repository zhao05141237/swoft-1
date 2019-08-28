<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 *  品牌补充表
 * Class TbBrandNew
 *
 * @since 2.0
 *
 * @Entity(table="tb_brand_new", pool="fanli.pool")
 */
class TbBrandNew extends Model
{
    /**
     * 自增id
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 品牌id
     *
     * @Column(name="brand_id", prop="brandId")
     *
     * @var int
     */
    private $brandId;

    /**
     * 品牌名
     *
     * @Column(name="brand_name", prop="brandName")
     *
     * @var string|null
     */
    private $brandName;

    /**
     * 匹配品牌名
     *
     * @Column()
     *
     * @var string|null
     */
    private $brandnameraw;

    /**
     * 品牌等级
     *
     * @Column(name="brand_level", prop="brandLevel")
     *
     * @var string|null
     */
    private $brandLevel;


    /**
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param int $brandId
     *
     * @return void
     */
    public function setBrandId(int $brandId): void
    {
        $this->brandId = $brandId;
    }

    /**
     * @param string|null $brandName
     *
     * @return void
     */
    public function setBrandName(?string $brandName): void
    {
        $this->brandName = $brandName;
    }

    /**
     * @param string|null $brandnameraw
     *
     * @return void
     */
    public function setBrandnameraw(?string $brandnameraw): void
    {
        $this->brandnameraw = $brandnameraw;
    }

    /**
     * @param string|null $brandLevel
     *
     * @return void
     */
    public function setBrandLevel(?string $brandLevel): void
    {
        $this->brandLevel = $brandLevel;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getBrandId(): ?int
    {
        return $this->brandId;
    }

    /**
     * @return string|null
     */
    public function getBrandName(): ?string
    {
        return $this->brandName;
    }

    /**
     * @return string|null
     */
    public function getBrandnameraw(): ?string
    {
        return $this->brandnameraw;
    }

    /**
     * @return string|null
     */
    public function getBrandLevel(): ?string
    {
        return $this->brandLevel;
    }

}
