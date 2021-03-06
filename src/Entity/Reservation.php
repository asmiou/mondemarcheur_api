<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 * @ApiResource(
 *     attributes={
 *          "pagination_enabled"=true,
 *          "items_per_page"=30,
 *          "order": {"amount": "desc"}
 *     },
 *     collectionOperations={"post"},
 *     itemOperations={"get"}
 * )
 */
class Reservation
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
    private $reference;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     *     message="Le nombre de bébé est obligatoire"
     * )
     * @Assert\Positive(
     *     message="Le nombre de bébé ne peut pas être nulle"
     * )
     */
    private $baby;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     *     message="Le nombre d'enfants est obligatoire"
     * )
     * @Assert\Positive(
     *     message="Le nombre d'enfant ne peut pas être nulle"
     * )
     */
    private $child;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     *     message="Le nombre d'adulte est obligatoire"
     * )
     * @Assert\GreaterThan(
     *     value=0,
     *     message="Le nombre d'adulte ne peut pas être nulle"
     * )
     */
    private $adult;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(
     *     message="La date d'arrivé est obligatoire"
     * )
     * @Assert\GreaterThan(
     *     value="+2 hours",
     *     message="La date d'arrivée doit être au moins dans 2h"
     * )
     * @Assert\DateTime(
     *     message="La date doit être au format YYYY-MM-DD H:i:s"
     * )
     * @var string A "YYYY-MM-DD H:i:s" formatted value
     */
    private $arrivedAt;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(
     *     message="La date de départ est obligatoire"
     * )
     * @Assert\GreaterThan(
     *     value="+3 hours",
     *     message="La date de départ doit être au moins dans 3h"
     * )
     * @Assert\DateTime(
     *     message="La date doit être au format YYYY-MM-DD H:i:s"
     * )
     * @var string A "YYYY-MM-DD H:i:s" formatted value
     */
    private $leavedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservation")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity=Realty::class, inversedBy="reservation")
     */
    private $realty;

    /**
     * @ORM\OneToMany(targetEntity=Payment::class, mappedBy="reservation")
     */
    private $payments;

    /**
     * @ORM\OneToMany(targetEntity=Status::class, mappedBy="reservation")
     */
    private $status;

    /**
     * @return float
     */
    public function amount():float {
        return array_reduce($this->realty->toArray(), function(float $total, Realty $realty){
           return $total+$realty->getPrice();
        });
    }

    public function __construct()
    {
        $this->payments = new ArrayCollection();
        $this->status = new ArrayCollection();
        $this->createdAt = new \DateTime();
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

    public function getBaby(): ?int
    {
        return $this->baby;
    }

    public function setBaby(int $baby): self
    {
        $this->baby = $baby;

        return $this;
    }

    public function getChild(): ?int
    {
        return $this->child;
    }

    public function setChild(int $child): self
    {
        $this->child = $child;

        return $this;
    }

    public function getAdult(): ?int
    {
        return $this->adult;
    }

    public function setAdult(int $adult): self
    {
        $this->adult = $adult;

        return $this;
    }

    public function getArrivedAt(): ?\DateTimeInterface
    {
        return $this->arrivedAt;
    }

    public function setArrivedAt($arrivedAt): self
    {
        $this->arrivedAt = $arrivedAt;

        return $this;
    }

    public function getLeavedAt(): ?\DateTimeInterface
    {
        return $this->leavedAt;
    }

    public function setLeavedAt($leavedAt): self
    {
        $this->leavedAt = $leavedAt;

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

    public function getCustomer(): ?User
    {
        return $this->customer;
    }

    public function setCustomer(?User $customer): self
    {
        $this->customer = $customer;

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

    /**
     * @return Collection|Payment[]
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payment $payment): self
    {
        if (!$this->payments->contains($payment)) {
            $this->payments[] = $payment;
            $payment->setReservation($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): self
    {
        if ($this->payments->contains($payment)) {
            $this->payments->removeElement($payment);
            // set the owning side to null (unless already changed)
            if ($payment->getReservation() === $this) {
                $payment->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Status[]
     */
    public function getStatus(): Collection
    {
        return $this->status;
    }

    public function addStatus(Status $status): self
    {
        if (!$this->status->contains($status)) {
            $this->status[] = $status;
            $status->setReservation($this);
        }

        return $this;
    }

    public function removeStatus(Status $status): self
    {
        if ($this->status->contains($status)) {
            $this->status->removeElement($status);
            // set the owning side to null (unless already changed)
            if ($status->getReservation() === $this) {
                $status->setReservation(null);
            }
        }

        return $this;
    }
}
