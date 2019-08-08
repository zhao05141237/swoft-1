<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class Post
 *
 * @since 2.0
 *
 * @Entity(table="post")
 */
class Post extends Model
{
    /**
     * 
     * @Id()
     * @Column()
     * @var int|null
     */
    private $id;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    private $title;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    private $content;

    /**
     * 
     *
     * @Column()
     * @var string|null
     */
    private $tags;

    /**
     * 
     *
     * @Column()
     * @var int|null
     */
    private $status;

    /**
     * 
     *
     * @Column(name="author_id",prop="authorId")
     * @var int|null
     */
    private $authorId;

    /**
     * 
     *
     * @Column(name="created_at",prop="createdAt")
     * @var int|null
     */
    private $createdAt;

    /**
     * 
     *
     * @Column(name="updated_at",prop="updatedAt")
     * @var int|null
     */
    private $updatedAt;


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
     * @param string|null $title
     * @return self
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string|null $content
     * @return self
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @param string|null $tags
     * @return self
     */
    public function setTags(?string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @param int|null $status
     * @return self
     */
    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param int|null $authorId
     * @return self
     */
    public function setAuthorId(?int $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * @param int|null $createdAt
     * @return self
     */
    public function setCreatedAt(?int $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @param int|null $updatedAt
     * @return self
     */
    public function setUpdatedAt(?int $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string|null
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return int|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int|null
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @return int|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return int|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

}
