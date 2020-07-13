<?php

namespace App\Entity;

use App\Repository\PieceRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PieceRepository::class)
 * @ApiResource
 */
class Piece
{
    public function __construct(){
        $this->quantity=1;
        $this->area=10;
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(
     *     message="La surface est obligatoire"
     * )
     * @Assert\GreaterThan(
     *     value=10,
     *     message="La surface minimale acceptée est de 10 m²"
     * )
     */
    private $area;

    /**
     * @ORM\Column(type="integer")
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
     * @ORM\ManyToOne(targetEntity=Realty::class, inversedBy="piece")
     */
    private $realty;

    /**
     * @ORM\ManyToOne(targetEntity=TypePiece::class)
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArea(): ?float
    {
        return $this->area;
    }

    public function setArea(float $area): self
    {
        $this->area = $area;

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

    public function getRealty(): ?Realty
    {
        return $this->realty;
    }

    public function setRealty(?Realty $realty): self
    {
        $this->realty = $realty;

        return $this;
    }

    public function getType(): ?TypePiece
    {
        return $this->type;
    }

    public function setType(?TypePiece $type): self
    {
        $this->type = $type;

        return $this;
    }
}
