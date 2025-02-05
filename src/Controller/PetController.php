<?php

namespace App\Controller;

use App\Service\PetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/pet', name: 'api_pet_')]
class PetController extends AbstractController
{
    private PetService $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    #[Route('', name: 'list_pets', methods: ['GET'])]
    public function list(): JsonResponse
    {
        return new JsonResponse($this->petService->listPets());
    }

    #[Route('', name: 'create_pet', methods: ['POST'])]
    public function createPet(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        return $this->petService->createPet($data);
    }
}
