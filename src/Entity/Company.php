<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\OneToMany(targetEntity=JobAd::class, mappedBy="Company", orphanRemoval=true)
     */
    private $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection|JobAd[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(JobAd $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
            $relation->setCompany($this);
        }

        return $this;
    }

    public function removeRelation(JobAd $relation): self
    {
        if ($this->relation->contains($relation)) {
            $this->relation->removeElement($relation);
            // set the owning side to null (unless already changed)
            if ($relation->getCompany() === $this) {
                $relation->setCompany(null);
            }
        }

        return $this;
    }
}
