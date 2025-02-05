<?php
// src/Entity/Pet.php
namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Pet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[Assert\NotBlank(message: "Name cannot be blank.")]
    #[Assert\Length(
        max: 255,
        maxMessage: "Name cannot be longer than {{ limit }} characters."
    )]
    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\ManyToOne(targetEntity: PetType::class)]
    #[ORM\JoinColumn(name: "pet_type_id", referencedColumnName: "id", nullable: false)]
    private PetType $petType;

    #[ORM\ManyToOne(targetEntity: Breed::class)]
    #[ORM\JoinColumn(name: "breed_id", referencedColumnName: "id", nullable: true)]
    private ?Breed $breed = null;  // ✅ Fix: Allow breed to be nullable
    
    #[Assert\Date]
    #[Assert\NotBlank]
    #[ORM\Column]
    private string $dateOfBirth;
 
    #[Assert\NotBlank(message: "Gender cannot be blank.")]
    #[Assert\Choice(
        choices: ["Male", "Female"],
        message: "Gender must be one of the following: Male, Female."
    )]
    #[ORM\Column(type: "string", length: 10)]
    private string $gender;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPetType(): PetType
    {
        return $this->petType;
    }

    public function setPetType(PetType $petType): self
    {
        $this->petType = $petType;  
        return $this;
    }

    // Getters and Setters
    public function getBreed(): ?Breed
    {
        return $this->breed;
    }

    public function setBreed(?Breed $breed): self
    {
        $this->breed = $breed;
        return $this;
    }

    public function getDateOfBirth(): string
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(string $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

}
