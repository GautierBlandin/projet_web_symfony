<?php

namespace App\Entity;

use App\Repository\JobAdRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobAdRepository::class)
 */
class JobAd
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
    private $Title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CompanyName;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="relation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Company;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->CompanyName;
    }

    public function setCompanyName(string $CompanyName): self
    {
        $this->CompanyName = $CompanyName;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->Company;
    }

    public function setCompany(?Company $Company): self
    {
        $this->Company = $Company;

        return $this;
    }
}
