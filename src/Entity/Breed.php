<?php

namespace App\Entity;

use App\Repository\BreedRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BreedRepository::class)]
class Breed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private string $name;

    #[ORM\ManyToOne(inversedBy: 'breed')]
    #[ORM\JoinColumn(nullable: false)]
    private PetType $petType;

    #[ORM\Column(type: "boolean")]
    private bool $isDangerousAnimal = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPetType(): ?PetType
    {
        return $this->petType;
    }

    public function setPetType(?PetType $petType): static
    {
        $this->petType = $petType;

        return $this;
    }

    public function isDangerousAnimal(): bool
    {
        return $this->isDangerousAnimal;
    }

    public function setIsDangerousAnimal(bool $isDangerousAnimal): self
    {
        $this->isDangerousAnimal = $isDangerousAnimal;
        return $this;
    }
}
