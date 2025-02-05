<?php

namespace App\Controller;

use App\Entity\Breed;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
 
#[Route('/api/pet-type', name: 'api_pet_breeds')]
class BreedController extends AbstractController
{
    #[Route('/{petTypeId}/breeds', name: 'get_breeds_by_pet_type', methods: ['GET'])]
    public function getBreedsByPetType(EntityManagerInterface $em, int $petTypeId): JsonResponse
    {
        $breeds = $em->getRepository(Breed::class)->findBy(['petType' => $petTypeId]);
        return new JsonResponse(array_map(fn($b) => [
            'id' => $b->getId(),
            'name' => $b->getName(),
            'isDangerous' => $b->isDangerousAnimal(),
        ], $breeds));
    }
}
