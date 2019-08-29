<?php

namespace App\Repositories;

use App\Animal;
use App\Adoption;
use App\Person;
use App\Repositories\Interfaces\IAdoptionsRepository;

class AdoptionsRepository implements IAdoptionsRepository {

    public function all() {
        return Adoption::all();
    }

    public function allPaginated($perPage = 10) {
        return Adoption::latest()->paginate($perPage);
    }

    public function get($id) {
        return Adoption::find($id);
    }

    public function getByPerson($personId) {
        return Adoption::where('person_id', $personId)->get();
    }

    public function addFromInput($formFields) {
        // Add new animal adoptions entry to existing animal
        $animal = Animal::find($formFields['animal']);
        $person = Person::find($formFields['person']);
        if ($animal !== null && $person !== null) {
            $animal->adopters()->attach(
                $person->id, 
                ['adoption_date' => $formFields['adoption-date'],
                 'notes' => $formFields['notes']
                ]);
            return true;
        } else {
            return false;
        }
    }

    public function updateFromInput($adoption, $formFields) {
        $adoption->update(['notes' => $formFields['notes']]);
    }

    public function delete($adoption) {
        if ($adoption == null)
            return;
        $adoption->delete();
    }
}