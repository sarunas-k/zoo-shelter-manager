<?php

namespace App\Repositories;

use App\Animal;
use App\Reclaim;
use App\Person;
use App\Repositories\Interfaces\IReclaimsRepository;

class ReclaimsRepository implements IReclaimsRepository {

    public function all() {
        return Reclaim::all();
    }

    public function allPaginated($perPage = 10) {
        return Reclaim::latest()->paginate($perPage);
    }

    public function get($id) {
        return Reclaim::find($id);
    }

    public function getByPerson($personId) {
        return Reclaim::where('person_id', $personId)->get();
    }

    public function addFromInput($request) {
        // Add new animal reclaim entry to existing animal
        $animal = Animal::find($request->input('animal'));
        $person = Person::find($request->input('person'));
        if ($animal !== null && $person !== null) {
            $animal->reclaimers()->attach(
                $person->id, 
                [
                    'date' => $request->input('date'),
                    'created_at' => now()
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