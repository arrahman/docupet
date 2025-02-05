<?php

namespace App\Service;

use App\Entity\Pet;
use App\Entity\PetType;
use App\Entity\Breed;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class PetService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function listPets(): array
    {
        $pets = $this->em->getRepository(Pet::class)->findAll();

        return array_map(function ($pet) {
            return [
                'id' => $pet->getId(),
                'name' => $pet->getName(),
                'type' => $pet->getPetType()->getName(),
                'breed' => $pet->getBreed() ? $pet->getBreed()->getName() : 'Unknown',
                'gender' => $pet->getGender(),
                'dateOfBirth' => $pet->getDateOfBirth(),
                'isDangerous' => $pet->getBreed() ? $pet->getBreed()->isDangerousAnimal() : false,
            ];
        }, $pets);
    }

    public function createPet(array $data): JsonResponse
    {
        $petType = $this->em->getRepository(PetType::class)->find($data['petTypeId']);

        if (!$petType) {
            return new JsonResponse(["error" => "Invalid pet type"], 400);
        }

        $breed = null;

        if ($data['breedId']) {
            $breed = $this->em->getRepository(Breed::class)->find($data['breedId']);
        }

        if (!$breed && $data['breedName'] != 'unknown') {
            // If breed not found, create a new one
            $breed = new Breed();
            $breed->setName($data['breedName']);
            $breed->setPetType($petType);
            $this->em->persist($breed);
            $this->em->flush();
        }

        $pet = new Pet();
        $pet->setName($data['name']);
        $pet->setPetType($petType);
        $pet->setGender($data['gender']);

        if ($breed) {
            $pet->setBreed($breed);
        }

        if (!empty($data['dateOfBirth'])) {
            $pet->setDateOfBirth($data['dateOfBirth']);
        } elseif (!empty($data['age'])) {
            // Convert age to birth year
            $currentYear = (int) date('Y');
            $birthYear = $currentYear - (int) $data['age'];
            $dateOfBirth = "$birthYear-01-01"; // Assume January 1st
            $pet->setDateOfBirth($dateOfBirth);
        } else {
            $pet->setDateOfBirth(''); // No age or date provided
        }

        $this->em->persist($pet);
        $this->em->flush();

        return new JsonResponse([
            'id' => $pet->getId(),
            'name' => $pet->getName(),
            'type' => $pet->getPetType()->getName(),
            'breed' => $pet->getBreed() ? $pet->getBreed()->getName() : 'Unknown',
            'gender' => $pet->getGender(),
            'dateOfBirth' => $pet->getDateOfBirth(),
            'isDangerous' => $pet->getBreed() ? $pet->getBreed()->isDangerousAnimal() : false,
        ], 201);
    }
}
