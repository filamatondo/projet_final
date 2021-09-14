<?php

namespace App\Entity;

use App\Repository\AmiRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AmiRepository::class)
 */
class Ami
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ListeAmi::class, inversedBy="amis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $listeAmi;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="amis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getListeAmi(): ?ListeAmi
    {
        return $this->listeAmi;
    }

    public function setListeAmi(?ListeAmi $listeAmi): self
    {
        $this->listeAmi = $listeAmi;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
