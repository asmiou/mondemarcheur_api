<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Repository\RealtyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RealtyRepository::class)
 * @ApiResource(
 *      attributes={
 *          "pagination_enabled"=true,
 *          "items_per_page"=30,
 *      },
 *     normalizationContext={"groups"={"realtyRead"}}
 *
 * )
 * @ApiFilter(
 *     SearchFilter::class,
 *     properties={
 *          "reference":"exact",
 *          "name":"start",
 *          "description":"partial"
 *      }
 * )
 * @ApiFilter(
 *     DateFilter::class,
 *     properties={"createdAt"}
 * )
 * @ApiFilter(
 *     BooleanFilter::class,
 *     properties={"isAvailable"}
 * )
 */
class Realty
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"realtyRead","userRead"})
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"realtyRead","userRead"})
     * @Assert\NotBlank(
     *     message="Le nom est obligatoire"
     * )
     * @Assert\Length(
     *     min=6,
     *     minMessage="Le nom est trop court, il doit faire au moins 6 caractères."
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups({"realtyRead"})
     */
    private $floor;

    /**
     * @ORM\Column(type="float")
     * @Groups({"realtyRead","userRead"})
     * @Assert\NotBlank(
     *     message="Le prix est obligatoire"
     * )
     * @Assert\GreaterThan(
     *     value=0,
     *     message="Le prix ne peut pas être nulle"
     * )
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     * @Groups({"realtyRead","userRead"})
     * @Assert\Length(
     *     min="100",
     *     minMessage="La description est rop courte, elle doit faire au minmum 100 caractères"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"realtyRead","userRead"})
     * @Assert\NotBlank(
     *     message="La quantité est obligatoire"
     * )
     * @Assert\GreaterThan(
     *     value=0,
     *     message="La quantité ne peut pas être nulle"
     * )
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     * @Groups({"realtyRead","userRead"})
     * @Assert\NotBlank(
     *     message="La surface est obligatoire"
     * )
     * @Assert\GreaterThan(
     *     value=10,
     *     message="La surface minimale acceptée est de 10 m²"
     * )
     */
    private $surface;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"realtyRead","userRead"})
     */
    private $isAvailable;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"realtyRead"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Property::class, inversedBy="realty")
     * @Groups({"realtyRead"})
     */
    private $property;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryRealty::class)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=TypeRealty::class)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=TypeCadence::class)
     */
    private $cadencePayment;

    /**
     * @ORM\ManyToOne(targetEntity=TypeAiring::class)
     */
    private $airing;

    /**
     * @ORM\OneToMany(targetEntity=Furniture::class, mappedBy="realty")
     */
    private $furniture;

    /**
     * @ORM\OneToMany(targetEntity=Piece::class, mappedBy="realty")
     */
    private $piece;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="realty")
     */
    private $gallery;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="realty")
     */
    private $reservation;

    public function __construct()
    {
        $this->furniture = new ArrayCollection();
        $this->piece = new ArrayCollection();
        $this->gallery = new ArrayCollection();
        $this->reservation = new ArrayCollection();
        $this->createdAt=new \DateTime();
        $this->isAvailable = false;
        $this->quantity = 1;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function setFloor(string $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getIsAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): self
    {
        $this->isAvailable = $isAvailable;

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

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): self
    {
        $this->property = $property;

        return $this;
    }

    public function getCategory(): ?CategoryRealty
    {
        return $this->category;
    }

    public function setCategory(?CategoryRealty $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getType(): ?TypeRealty
    {
        return $this->type;
    }

    public function setType(?TypeRealty $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCadencePayment(): ?TypeCadence
    {
        return $this->cadencePayment;
    }

    public function setCadencePayment(?TypeCadence $cadencePayment): self
    {
        $this->cadencePayment = $cadencePayment;

        return $this;
    }

    public function getAiring(): ?TypeAiring
    {
        return $this->airing;
    }

    public function setAiring(?TypeAiring $airing): self
    {
        $this->airing = $airing;

        return $this;
    }

    /**
     * @return Collection|Furniture[]
     */
    public function getFurniture(): Collection
    {
        return $this->furniture;
    }

    public function addFurniture(Furniture $furniture): self
    {
        if (!$this->furniture->contains($furniture)) {
            $this->furniture[] = $furniture;
            $furniture->setRealty($this);
        }

        return $this;
    }

    public function removeFurniture(Furniture $furniture): self
    {
        if ($this->furniture->contains($furniture)) {
            $this->furniture->removeElement($furniture);
            // set the owning side to null (unless already changed)
            if ($furniture->getRealty() === $this) {
                $furniture->setRealty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Piece[]
     */
    public function getPiece(): Collection
    {
        return $this->piece;
    }

    public function addPiece(Piece $piece): self
    {
        if (!$this->piece->contains($piece)) {
            $this->piece[] = $piece;
            $piece->setRealty($this);
        }

        return $this;
    }

    public function removePiece(Piece $piece): self
    {
        if ($this->piece->contains($piece)) {
            $this->piece->removeElement($piece);
            // set the owning side to null (unless already changed)
            if ($piece->getRealty() === $this) {
                $piece->setRealty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getGallery(): Collection
    {
        return $this->gallery;
    }

    public function addGallery(Media $gallery): self
    {
        if (!$this->gallery->contains($gallery)) {
            $this->gallery[] = $gallery;
            $gallery->setRealty($this);
        }

        return $this;
    }

    public function removeGallery(Media $gallery): self
    {
        if ($this->gallery->contains($gallery)) {
            $this->gallery->removeElement($gallery);
            // set the owning side to null (unless already changed)
            if ($gallery->getRealty() === $this) {
                $gallery->setRealty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservation(): Collection
    {
        return $this->reservation;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservation->contains($reservation)) {
            $this->reservation[] = $reservation;
            $reservation->setRealty($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservation->contains($reservation)) {
            $this->reservation->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getRealty() === $this) {
                $reservation->setRealty(null);
            }
        }

        return $this;
    }
}
