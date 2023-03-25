<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: UsersRepository::class)]

#[ORM\HasLifecycleCallbacks()]

class Users implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $username = null;

    #[ORM\Column(length: 12)]
    private ?string $password = null;
    #[ORM\Column(type: 'string', length: 255, nullable: false, options: ['default' => ''])]
    private $passwordHash;
    
    
    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $entryTime = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $exitTime = [];

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $stops = [];

    #[ORM\Column(length: 255)]
    private ?string $vacations = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $workshops = [];

    #[ORM\Column]
    private ?bool $documents = null;

    #[ORM\Column(length: 255)]
    private ?string $receiveNotifications = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getRoles(): array
    {
        
    }

    public function getUserIdentifier(): string
    {
        
    }
    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
  

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    

    public function getRole(): array
    {
        return $this->role;
    }
    /** 
    * @inheritDoc
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials(): void
    {
        // no almacena contraseñas, no hace falta código
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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
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

    public function getEntryTime(): ?\DateTimeInterface
    {
        return $this->entryTime;
    }

    public function setEntryTime(?\DateTimeInterface $entryTime): self
    {
        $this->entryTime = $entryTime;

        return $this;
    }

    public function getExitTime(): ?\DateTimeInterface
{
    if (is_array($this->exitTime)) {
        return null;
    }

    return $this->exitTime;
}

public function setExitTime(?\DateTimeInterface $exitTime): self
{
    $this->exitTime = $exitTime;

    return $this;
}

    public function getStops(): ?\DateTimeInterface
    {
        return count($this->stops) > 0 ? $this->stops[0] : null;
    }

    public function setStops(?\DateTimeInterface $stops): self
    {
        $this->stops = $stops;

        return $this;
    }

    

    public function getVacations(): ?string
    {
        return $this->vacations;
    }

    public function setVacations(string $vacations): self
    {
        $this->vacations = $vacations;

        return $this;
    }

    public function getWorkshops(): array
    {
        return $this->workshops;
    }

    public function setWorkshops(?array $workshops): self
    {
        $this->workshops = $workshops;

        return $this;
    }

    public function isDocuments(): ?bool
    {
        return $this->documents;
    }

    public function setDocuments(bool $documents): self
    {
        $this->documents = $documents;

        return $this;
    }

    public function getReceiveNotifications(): ?string
    {
        return $this->receiveNotifications;
    }

    public function setReceiveNotifications(string $receiveNotifications): self
    {
        $this->receiveNotifications = $receiveNotifications;

        return $this;
    }
}
