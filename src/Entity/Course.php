<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Category;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CourseRepository;

/**
 * @ORM\Table(name="Course", options={"collate"="utf8_bin"}, indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="idCategory", columns={"idCategory"})})
 * @ORM\Entity(repositoryClass=CourseRepository::class)
 */
class Course
{

    /**
     * @var int
     * 
     * @ORM\Column(name="idCourse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCourse;

    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="idUser", nullable=false)
     * })
     */
    private $idUser;

    /**
     * @var Category
     * 
     * @ORM\ManyToOne(targetEntity=Category::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategory", referencedColumnName="idCategory", nullable=false)
     * })
     */
    private $idCategory;

    /**
     * @var string
     * 
     * @ORM\Column(name="caption", length=255, nullable=false)
     */
    private $caption;

    /**
     * @var null|string
     * 
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var null|string
     * 
     * @ORM\Column(name="filelink", type="string", length=255, nullable=true, options={"default"=NULL})
     */
    private $filelink = null;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="starred", type="boolean", nullable=false, options={"default"="0"})
     */
    private $starred = false;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $active = true;

    public function getIdCourse(): ?int
    {
        return $this->idCourse;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdCategory(): ?Category
    {
        return $this->idCategory;
    }

    public function setIdCategory(Category $idCategory): self
    {
        $this->idCategory = $idCategory;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFilelink(): ?string
    {
        return $this->filelink;
    }

    public function setFilelink(?string $filelink): self
    {
        $this->filelink = $filelink;

        return $this;
    }

    public function getStarred(): ?bool
    {
        return $this->starred;
    }

    public function setStarred(bool $starred): self
    {
        $this->starred = $starred;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
