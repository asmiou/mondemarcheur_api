<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CurrencyRepository::class)
 * @ApiResource
 */
class Currency
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
     *     message="Le titre de la devise est obligatoire"
     * )
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(
     *     message="Le code iso de la devise est obligatoire"
     * )
     * @Assert\Length(
     *     min=3,
     *     minMessage="Le code iso de la devise doit avoir au minimum 3 caractères"
     * )
     */
    private $iso;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $icon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $flag;

    /**
     * @ORM\OneToMany(targetEntity=Rate::class, mappedBy="currencyFrom")
     */
    private $rateFrom;

    /**
     * @ORM\OneToMany(targetEntity=Rate::class, mappedBy="currencyTo")
     */
    private $rateTo;

    public function __construct()
    {
        $this->rateFrom = new ArrayCollection();
        $this->rateTo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getIso(): ?string
    {
        return $this->iso;
    }

    public function setIso(string $iso): self
    {
        $this->iso = $iso;

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

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * @return Collection|Rate[]
     */
    public function getRateFrom(): Collection
    {
        return $this->rateFrom;
    }

    public function addRateFrom(Rate $rateFrom): self
    {
        if (!$this->rateFrom->contains($rateFrom)) {
            $this->rateFrom[] = $rateFrom;
            $rateFrom->setCurrencyFrom($this);
        }

        return $this;
    }

    public function removeRateFrom(Rate $rateFrom): self
    {
        if ($this->rateFrom->contains($rateFrom)) {
            $this->rateFrom->removeElement($rateFrom);
            // set the owning side to null (unless already changed)
            if ($rateFrom->getCurrencyFrom() === $this) {
                $rateFrom->setCurrencyFrom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rate[]
     */
    public function getRateTo(): Collection
    {
        return $this->rateTo;
    }

    public function addRateTo(Rate $rateTo): self
    {
        if (!$this->rateTo->contains($rateTo)) {
            $this->rateTo[] = $rateTo;
            $rateTo->setCurrencyTo($this);
        }

        return $this;
    }

    public function removeRateTo(Rate $rateTo): self
    {
        if ($this->rateTo->contains($rateTo)) {
            $this->rateTo->removeElement($rateTo);
            // set the owning side to null (unless already changed)
            if ($rateTo->getCurrencyTo() === $this) {
                $rateTo->setCurrencyTo(null);
            }
        }

        return $this;
    }
}
