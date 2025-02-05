<?php

namespace App\DataFixtures;

use App\Entity\PetType;
use App\Entity\Breed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PetTypeBreedFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Define pet types
        $petTypes = [
            'Dog' => [],
            'Cat' => [],
        ];

        // Define breeds for each type
        $breeds = [
            'Dog' => [ 
                ['name' =>'Labrador', 'isDnagerous' => false],
                ['name' =>'Beagle', 'isDnagerous' => false],
                ['name' =>'Pitbull', 'isDnagerous' => true],
                ['name' =>'Mastiff', 'isDnagerous' => true],
            ], 
            'Cat' => [
                ['name' =>'Persian', 'isDnagerous' => false],
                ['name' =>'Siamese', 'isDnagerous' => false],
                ['name' =>'Maine Coon', 'isDnagerous' => false],
                ['name' =>'Bengal', 'isDnagerous' => false],
            ],
        ];

        $petTypeEntities = [];

        // Create pet types
        foreach ($petTypes as $type => $breedList) {
            $petType = new PetType();
            $petType->setName($type);
            $manager->persist($petType);
            $petTypeEntities[$type] = $petType; // Store reference
        }

        $manager->flush();

        // Create breeds
        foreach ($breeds as $type => $breedList) {
            foreach ($breedList as $b) {
                $breed = new Breed();
                $breed->setName($b['name']);
                $breed->setIsDangerousAnimal($b['isDnagerous']);
                $breed->setPetType($petTypeEntities[$type]); // Associate with PetType
                $manager->persist($breed);
            }
        }

        // Flush again to save breeds
        $manager->flush();
    }
}

