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
        return Adoption::orderBy('adoption_date', 'desc')->paginate($perPage);
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
                [
                    'adoption_date' => $formFields['adoption-date'],
                    'notes' => $formFields['notes'],
                    'created_at' => now()
                ]);
            return true;
        } else {
            return false;
        }
    }

    public function updateFromInput($adoption, $formFields) {
        $adoption['notes'] = $formFields['notes'];
        if(isset($formFields['return-date'])) {
            $adoption['return_date'] = $formFields['return-date'];
        }
        $adoption['updated_at'] = now();
        $adoption->save();
    }

    public function delete($adoption) {
        if ($adoption == null)
            return;
        $adoption->delete();
    }
}