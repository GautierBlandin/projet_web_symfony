<?php

namespace App\Entity;

use App\Repository\ApplicationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApplicationsRepository::class)
 */
class Applications
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $appliedDate;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $coverLetter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $availabilities;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="applications")
     */
    private $applicants;

    /**
     * @ORM\ManyToOne(targetEntity=Ads::class, inversedBy="applications")
     */
    private $ad;

    public function __construct()
    {
        $this->applicants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAppliedDate(): ?\DateTimeInterface
    {
        return $this->appliedDate;
    }

    public function setAppliedDate(?\DateTimeInterface $appliedDate): self
    {
        $this->appliedDate = $appliedDate;

        return $this;
    }

    public function getCoverLetter(): ?string
    {
        return $this->coverLetter;
    }

    public function setCoverLetter(?string $coverLetter): self
    {
        $this->coverLetter = $coverLetter;

        return $this;
    }

    public function getAvailabilities(): ?string
    {
        return $this->availabilities;
    }

    public function setAvailabilities(?string $availabilities): self
    {
        $this->availabilities = $availabilities;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getApplicants(): Collection
    {
        return $this->applicants;
    }

    /**
     * @return Collection|Ads[]
     */
    public function getAd(): ?ads
    {
        return $this->ad;
    }

    public function setAd(?ads $ad): self
    {
        $this->ad = $ad;

        return $this;
    }

}
