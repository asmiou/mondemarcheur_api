<?php

namespace App\Entity;

use App\Repository\TypePieceRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TypePieceRepository::class)
 * @ApiResource
 */
class TypePiece
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
     * @ORM\Column(type="text")
     * @Assert\NotBlank(
     *     message="La description est obligatoire"
     * )
     * @Assert\Length(
     *     min=60,
     *     minMessage="La description est trop courte, elle doit faire au moins 60 caratères"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $icon;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
}
