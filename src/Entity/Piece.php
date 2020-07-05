<?php

namespace App\Entity;

use App\Repository\PieceRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=PieceRepository::class)
 * @ApiResource
 */
class Piece
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $area;

    /**
     * @ORM\Column(type="integer")
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
