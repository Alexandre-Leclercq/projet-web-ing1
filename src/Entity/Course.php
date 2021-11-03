<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="Course", options={"collate"="utf8_bin"})
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
     * @var int
     * 
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     */
    private $idUser;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCourse(): ?int
    {
        return $this->idCourse;
    }

    public function setIdCourse(int $idCourse): self
    {
        $this->idCourse = $idCourse;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;

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
