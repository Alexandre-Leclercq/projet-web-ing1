<?php

namespace App\Entity;

use App\Entity\Course;
use App\Entity\Chapter;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CourseStatusRepository;

/**
 * @ORM\Table(name="CourseStatus", options={"collate"="utf8_bin"}, indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="idCourse", columns={"idCourse"}), @ORM\Index(name="lastChapterReading", columns={"lastChapterReading"})})
 * @ORM\Entity(repositoryClass=CourseStatusRepository::class)
 */
class CourseStatus
{
    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="idUser", nullable=false)
     * })
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idUser;

    /**
     * @var Course
     * 
     * @ORM\ManyToOne(targetEntity=Course::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCourse", referencedColumnName="idCourse", nullable=false)
     * })
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idCourse;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="starred", type="boolean", nullable=false, options={"default"="0"})
     */
    private $starred = false;

    /**
     * @var null|\DateTimeInterface
     * 
     * @ORM\Column(name="lastDatetime", type="datetime", nullable=true)
     */
    private $lastDatetime = null;

    /**
     * @var null|Chapter
     * 
     * @ORM\ManyToOne(targetEntity=Chapter::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lastChapterReading", referencedColumnName="idChapter", nullable=true)
     * })
     */
    private $lastChapterReading;

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdCourse(): ?Course
    {
        return $this->idCourse;
    }

    public function setIdCourse(Course $idCourse): self
    {
        $this->idCourse = $idCourse;

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

    public function getLastDatetime(): ?\DateTimeInterface
    {
        return $this->lastDatetime;
    }

    public function setLastDatetime(?\DateTimeInterface $lastDatetime): self
    {
        $this->lastDatetime = $lastDatetime;

        return $this;
    }

    public function getLastChapterReading(): ?Chapter
    {
        return $this->lastChapterReading;
    }

    public function setLastChapterReading(?Chapter $lastChapterReading): self
    {
        $this->lastChapterReading = $lastChapterReading;

        return $this;
    }
}
