<?php

namespace App\Entity;

use App\Repository\TypeStatutRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=TypeStatutRepository::class)
 * @ApiResource
 */
class TypeStatut
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $labelColor;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $icon;

    /**
     * @ORM\Column(type="integer")
     */
    private $step;

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

    public function getLabelColor(): ?string
    {
        return $this->labelColor;
    }

    public function setLabelColor(string $labelColor): self
    {
        $this->labelColor = $labelColor;

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

    public function getStep(): ?int
    {
        return $this->step;
    }

    public function setStep(int $step): self
    {
        $this->step = $step;

        return $this;
    }
}
