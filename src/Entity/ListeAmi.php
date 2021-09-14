<?php

namespace App\Entity;

use App\Repository\ListeAmiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListeAmiRepository::class)
 */
class ListeAmi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="listeAmi", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Ami::class, mappedBy="listeAmi")
     */
    private $amis;

    public function __construct()
    {
        $this->amis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Ami[]
     */
    public function getAmis(): Collection
    {
        return $this->amis;
    }

    public function addAmi(Ami $ami): self
    {
        if (!$this->amis->contains($ami)) {
            $this->amis[] = $ami;
            $ami->setListeAmi($this);
        }

        return $this;
    }

    public function removeAmi(Ami $ami): self
    {
        if ($this->amis->removeElement($ami)) {
            // set the owning side to null (unless already changed)
            if ($ami->getListeAmi() === $this) {
                $ami->setListeAmi(null);
            }
        }

        return $this;
    }
}
