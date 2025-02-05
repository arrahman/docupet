<?php

namespace App\Controller;

use App\Entity\PetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/pet-types', name: 'api_pet_')]
class PetTypeController extends AbstractController
{
    #[Route('', name: 'get_pet_types', methods: ['GET'])]
    public function getPetTypes(EntityManagerInterface $em): JsonResponse
    {
        $petTypes = $em->getRepository(PetType::class)->findAll();
        return new JsonResponse(
            array_map(
                fn($pt) => [
                    'id' => $pt->getId(),
                    'name' => $pt->getName()
                ],
                $petTypes
            )
        );
    }
}
