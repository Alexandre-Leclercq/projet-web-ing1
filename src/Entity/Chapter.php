<?php

namespace App\Entity;

use App\Entity\Course;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChapterRepository;

/**
 * @ORM\Table(name="Chapter", options={"collate"="utf8_bin"}, uniqueConstraints={@ORM\UniqueConstraint(name="step", columns={"step", "idCourse"})},  indexes={@ORM\Index(name="idCourse", columns={"idCourse"})})
 * @ORM\Entity(repositoryClass=ChapterRepository::class)
 */
class Chapter
{

    /**
     * @var int
     * 
     * @ORM\Column(name="idChapter", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idChapter;

    /**
     * @var Course
     * 
     * @ORM\ManyToOne(targetEntity=Course::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCourse", referencedColumnName="idCourse", nullable=false)
     * })
     */
    private $idCourse;

    /**
     * @var int
     * 
     * @ORM\Column(name="step", type="integer",  nullable=false)
     */
    private $step;

    /**
     * @var string
     * 
     * @ORM\Column(name="caption", type="string", length=255, nullable=false)
     */
    private $caption;

    /**
     * @var string
     * 
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $active = true;

    public function getIdChapter(): ?int
    {
        return $this->idChapter;
    }

    public function getIdCourse(): ?Course
    {
        return $this->IdCourse;
    }

    public function setIdCourse(Course $IdCourse): self
    {
        $this->IdCourse = $IdCourse;

        return $this;
    }

    public function getStep(): ?int
    {
        return $this->step;
    }

    public function setStep(int $step): self
    {
        $this->step = $step;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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
