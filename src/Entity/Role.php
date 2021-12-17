<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="Role", options={"collate"="utf8_bin"})
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
{
    /**
     * @var int
     * 
     * @ORM\Column(name="idRole", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRole;

    /**
     * @var string
     * 
     * @ORM\Column(name="caption", type="string", length=255, nullable=false)
     */
    private $caption;

    /**
     * @var string
     * 
     * @ORM\Column(name="externCaption", type="string", length=255, nullable=false)
     */
    private $externCaption;

    /**
     * @var string
     * 
     * @ORM\Column(name="color", type="string", length=255, nullable=false)
     */
    private $color;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $active = true;

    public function getIdRole(): ?int
    {
        return $this->idRole;
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

    public function getExternCaption(): ?string
    {
        return $this->externCaption;
    }

    public function setExternCaption(string $externCaption): self
    {
        $this->externCaption = $externCaption;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

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
