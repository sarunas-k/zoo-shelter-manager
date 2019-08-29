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

    public function addFromInput($request) {
        // Add new animal adoptions entry to existing animal
        $animal = Animal::find($request->input('animal'));
        $person = Person::find($request->input('person'));
        if ($animal !== null && $person !== null) {
            $animal->adopters()->attach(
                $person->id, 
                ['adoption_date' => $request->input('adoption-date'),
                 'notes' => $request->input('notes')
                ]);
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $this->get($id)->delete();
    }
}