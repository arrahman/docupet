<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PetControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testListPets(): void
    {
        $this->client->request('GET', '/api/pet');
        
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');

        $responseData = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertIsArray($responseData);
    }

    public function testCreatePet(): void
    {
        $data = [
            'name' => 'Buddy',
            'petTypeId' => 1,
            'breedId' => 2,
            'gender' => 'Male',
            'dateOfBirth' => '2022-06-15'
        ];

        $this->client->request('POST', '/api/pet', [], [], [
            'CONTENT_TYPE' => 'application/json'
        ], json_encode($data));
        
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
        
        $responseData = json_decode($this->client->getResponse()->getContent(), true);
        
        $this->assertArrayHasKey('id', $responseData);
        $this->assertEquals('Buddy', $responseData['name']);
        $this->assertEquals('Male', $responseData['gender']);
        $this->assertEquals('2022-06-15', $responseData['dateOfBirth']);
    }
}
