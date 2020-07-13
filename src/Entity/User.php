<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"userRead"}},
 *     collectionOperations={"post"},
 *     itemOperations={"get","put"}
 * )
 * @ApiFilter(
 *      SearchFilter::class,
 *      properties={"firstName":"start","lastName":"start", "login":"exact","email":"exact"}
 * )
 * @ApiFilter(DateFilter::class, properties={"createdAt","birthday"})
 * @ApiFilter(
 *     BooleanFilter::class,
 *     properties={
 *          "isEnabled"
 *      }
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"userRead"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"userRead","realtyRead"})
     * @Assert\Email(
     *     message="L'email '{{ value }}' est invalide."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"userRead"})
     * @Assert\NotBlank(
     *     message="Le role est obligatoire"
     * )
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(
     *     message="Le mot de passe est obligatoire"
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"userRead","realtyRead"})
     * @Assert\NotBlank(
     *     message="Le nom est obligatoire"
     * )
     * @Assert\Length(
     *     min="3",
     *     minMessage="Le nom de est trop court, il doit faire au minimum 3 caractères"
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"userRead","realtyRead"})
     * @Assert\NotBlank(
     *     message="Le prénom est obligatoire"
     * )
     * @Assert\Length(
     *     min="3",
     *     minMessage="Le prénom de est trop court, il doit faire au minimum 3 caractères"
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=1)
     * @Groups({"userRead"})
     * @Assert\NotBlank(
     *     message="Le genre est obligatoire, soit F ou M"
     * )
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=60)
     * @Groups({"userRead","realtyRead"})
     * @Assert\NotBlank(
     *     message="Le numero de téléphone est obligatoire"
     * )
     */
    private $phone;

    /**
     * @ORM\Column(type="date")
     * @Groups({"userRead"})
     * @Assert\LessThan(
     *     value="-18 years",
     *     message="Vous devez avoir au moins 18 ans"
     * )
     */
    private $birthday;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"userRead"})
     */
    private $createAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"userRead"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"userRead","realtyRead"})
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"userRead"})
     * @Assert\NotBlank(
     *     message="La ville est obligatoire"
     * )
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"userRead"})
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"userRead"})
     * @Assert\NotBlank(
     *     message="Le login est obligatoire"
     * )
     */
    private $login;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"userRead"})
     */
    private $isEnabled;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="customer")
     * @Groups({"userRead"})
     */
    private $reservation;

    /**
     * @ORM\OneToMany(targetEntity=Status::class, mappedBy="user")
     * @Groups({"userRead"})
     */
    private $actionDone;

    /**
     * @ORM\OneToOne(targetEntity=Company::class, mappedBy="owner", cascade={"persist", "remove"})
     * @Groups({"realtyRead"})
     */
    private $company;

    public function __construct()
    {
        $this->setCreateAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
        $this->reservation = new ArrayCollection();
        $this->actionDone = new ArrayCollection();
        $this->createAt = new \DateTime();
        $this->isEnabled = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): self
    {
        $this->login = $login;

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
            $reservation->setCustomer($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservation->contains($reservation)) {
            $this->reservation->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getCustomer() === $this) {
                $reservation->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Status[]
     */
    public function getActionDone(): Collection
    {
        return $this->actionDone;
    }

    public function addActionDone(Status $actionDone): self
    {
        if (!$this->actionDone->contains($actionDone)) {
            $this->actionDone[] = $actionDone;
            $actionDone->setUser($this);
        }

        return $this;
    }

    public function removeActionDone(Status $actionDone): self
    {
        if ($this->actionDone->contains($actionDone)) {
            $this->actionDone->removeElement($actionDone);
            // set the owning side to null (unless already changed)
            if ($actionDone->getUser() === $this) {
                $actionDone->setUser(null);
            }
        }

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        // set (or unset) the owning side of the relation if necessary
        $newOwner = null === $company ? null : $this;
        if ($company->getOwner() !== $newOwner) {
            $company->setOwner($newOwner);
        }

        return $this;
    }
}
