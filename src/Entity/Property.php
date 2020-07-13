<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 * @ApiResource
 */
class Property
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Le titre est obligatoire"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(
     *     message="La description est obligaire"
     * )
     * @Assert\Length(
     *     min="100",
     *     minMessage="La description est rop courte, elle doit faire au minmum 100 caractères"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="La ville est obligatoire"
     * )
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $zip;

    /**
     * @ORM\Column(type="float")
     */
    private $lat;

    /**
     * @ORM\Column(type="float")
     */
    private $lon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(
     *     message="La date de construction est obligatoire"
     * )
     */
    private $buildAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSponsored;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isApproved;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isEnabled;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="property")
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=TypeProperty::class)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class)
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity=Realty::class, mappedBy="property")
     */
    private $realty;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="property")
     */
    private $document;

    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->realty = new ArrayCollection();
        $this->document = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->isEnabled = false;
        $this->isApproved = false;
        $this->isSponsored = false;

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): ?float
    {
        return $this->lon;
    }

    public function setLon(float $lon): self
    {
        $this->lon = $lon;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getBuildAt(): ?\DateTimeInterface
    {
        return $this->buildAt;
    }

    public function setBuildAt(\DateTimeInterface $buildAt): self
    {
        $this->buildAt = $buildAt;

        return $this;
    }

    public function getIsSponsored(): ?bool
    {
        return $this->isSponsored;
    }

    public function setIsSponsored(bool $isSponsored): self
    {
        $this->isSponsored = $isSponsored;

        return $this;
    }

    public function getIsApproved(): ?bool
    {
        return $this->isApproved;
    }

    public function setIsApproved(bool $isApproved): self
    {
        $this->isApproved = $isApproved;

        return $this;
    }

    public function getIsEnabled(): ?bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getType(): ?TypeProperty
    {
        return $this->type;
    }

    public function setType(?TypeProperty $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->setProperty($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
            // set the owning side to null (unless already changed)
            if ($service->getProperty() === $this) {
                $service->setProperty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Realty[]
     */
    public function getRealty(): Collection
    {
        return $this->realty;
    }

    public function addRealty(Realty $realty): self
    {
        if (!$this->realty->contains($realty)) {
            $this->realty[] = $realty;
            $realty->setProperty($this);
        }

        return $this;
    }

    public function removeRealty(Realty $realty): self
    {
        if ($this->realty->contains($realty)) {
            $this->realty->removeElement($realty);
            // set the owning side to null (unless already changed)
            if ($realty->getProperty() === $this) {
                $realty->setProperty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocument(): Collection
    {
        return $this->document;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->document->contains($document)) {
            $this->document[] = $document;
            $document->setProperty($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->document->contains($document)) {
            $this->document->removeElement($document);
            // set the owning side to null (unless already changed)
            if ($document->getProperty() === $this) {
                $document->setProperty(null);
            }
        }

        return $this;
    }
}
