<?php

namespace App\Entity;

use App\Repository\FurnitureRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FurnitureRepository::class)
 * @ApiResource
 */
class Furniture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThan(
     *     value=0,
     *     message="La quantité ne peut pas être nulle"
     * )
     * @Assert\Blank(
     *     message="La quantité est obligatoire"
     * )
     */
    private $quantity;

    /**
     * @Assert\GreaterThan(
     *     value=0,
     *     message="Le prix ne peut pas être nulle"
     * )
     * @Assert\NotBlank(
     *     message="Le prix est obligatoire"
     * )
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isEnabled;

    /**
     * @ORM\ManyToOne(targetEntity=Realty::class, inversedBy="furniture")
     */
    private $realty;

    /**
     * @ORM\ManyToOne(targetEntity=TypeFurniture::class)
     */
    private $type;

    public function __construct(){
        $this->quantity=1;
        $this->isEnabled=false;
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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

    public function getRealty(): ?Realty
    {
        return $this->realty;
    }

    public function setRealty(?Realty $realty): self
    {
        $this->realty = $realty;

        return $this;
    }

    public function getType(): ?TypeFurniture
    {
        return $this->type;
    }

    public function setType(?TypeFurniture $type): self
    {
        $this->type = $type;

        return $this;
    }
}
