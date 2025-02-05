# Pet Registration API

## Installation Steps

1. Run composer install
2. Run php bin/console doctrine:migrations:migrate
3. Run php bin/console doctrine:fixtures:load

### The Pet API can be accessible 

Get List of Pet, 
GET, http://127.0.0.1:8000/api/pet

Register a new Pet, 
POST  http://127.0.0.1:8000/api/pet

Payload:

{
    "name": "Name",
    "petTypeId": 1,
    "breedId": 1,
    "age": 2,
    "gender": "Male",
    "dateOfBirth": "",
    "breedName": "Labrador"
}

