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
        return Reclaim::orderBy('date', 'desc')->paginate($perPage);
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
                    'created_at' => now(),
                    'notes' => $request->input('notes')
                ]);
                return true;
        }
        return false;
    }

    public function updateFromInput($reclaim, $formFields) {
        $reclaim['notes'] = $formFields['notes'];
        if(isset($formFields['return-date'])) {
            $reclaim['return_date'] = $formFields['return-date'];
        }
        $reclaim['updated_at'] = now();
        $reclaim->save();
    }

    public function delete($reclaim) {
        $reclaim->delete();
    }
}