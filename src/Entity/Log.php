<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Chapter;
use App\Type\DateTimeKey;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LogRepository;

/**
 * @ORM\Table(name="Log", options={"collate"="utf8_bin"}, indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="idChapter", columns={"idChapter"})})
 * @ORM\Entity(repositoryClass=LogRepository::class)
 */
class Log
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
     * @var Chapter
     * 
     * @ORM\ManyToOne(targetEntity=Chapter::class)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idChapter", referencedColumnName="idChapter", nullable=false)
     * })
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idChapter;

    /**
     * @var DateTimeKey
     *
     * @ORM\Column(name="dateLog", type="datetimekey", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $dateLog;    

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function getIdChapter(): ?Chapter
    {
        return $this->idChapter;
    }

    public function getDateLog(): ?\DateTimeInterface
    {
        return $this->dateLog;
    }

    public function setPrimaryKey(User $idUser, Chapter $idChapter, \DateTimeInterface $dateLog): self
    {
        $this->idUser = $idUser;
        $this->idChapter = $idChapter;
        $this->dateLog = $dateLog;

        return $this;
    }
}
