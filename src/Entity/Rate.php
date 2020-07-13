<?php

namespace App\Entity;

use App\Repository\RateRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RateRepository::class)
 * @ApiResource()
 */
class Rate
{
    public function __construct(){
        $this->updatedAt=new \DateTime();
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
     *     message="La valeur du taux est obligatoire"
     * )
     * @Assert\Positive(
     *     message="La valeur du taux ne peut pas être nulle"
     * )
     */
    private $rateValue;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Currency::class, inversedBy="rateFrom")
     */
    private $currencyFrom;

    /**
     * @ORM\ManyToOne(targetEntity=Currency::class, inversedBy="rateTo")
     */
    private $currencyTo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRateValue(): ?float
    {
        return $this->rateValue;
    }

    public function setRateValue(float $rateValue): self
    {
        $this->rateValue = $rateValue;

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

    public function getCurrencyFrom(): ?Currency
    {
        return $this->currencyFrom;
    }

    public function setCurrencyFrom(?Currency $currencyFrom): self
    {
        $this->currencyFrom = $currencyFrom;

        return $this;
    }

    public function getCurrencyTo(): ?Currency
    {
        return $this->currencyTo;
    }

    public function setCurrencyTo(?Currency $currencyTo): self
    {
        $this->currencyTo = $currencyTo;

        return $this;
    }
}
