<?php

namespace App\Repositories;

use App\Animal;
use App\Foster;
use App\Person;
use App\Repositories\Interfaces\IFostersRepository;

class FostersRepository implements IFostersRepository {

    public function all() {
        return Foster::all();
    }

    public function allPaginated($perPage = 10) {
        return Foster::orderBy('foster_start_date', 'desc')->paginate($perPage);
    }

    public function get($id) {
        return Foster::find($id);
    }

    public function getByPerson($personId) {
        return Foster::where('person_id', $personId)->get();
    }

    public function addFromInput($request) {
        // Add new animal fosters entry to existing animal
        $animal = Animal::find($request->input('animal'));
        $person = Person::find($request->input('person'));
        if ($animal !== null && $person !== null) {
            $animal->fosterers()->attach(
                $person->id, 
                ['foster_start_date' => $request->input('start-date'),
                 'foster_end_date' => null,
                 'notes' => $request->input('notes'),
                 'created_at' => now()
                ]);
            return true;
        } else {
            return false;
        }
    }

    public function updateFromInput($foster, $formFields) {
        $foster['notes'] = $formFields['notes'];
        if(isset($formFields['end-date'])) {
            $foster['foster_end_date'] = $formFields['end-date'];
        }
        $foster['updated_at'] = now();
        $foster->save();
    }

    public function delete($id) {
        $this->get($id)->delete();
    }
}