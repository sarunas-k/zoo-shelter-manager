<?php

namespace App\Repositories;

use App\Person;
use App\Repositories\Interfaces\IPeopleRepository;

class PeopleRepository implements IPeopleRepository {

    public function all() {
        return Person::all();
    }

    public function allPaginated($perPage = 10) {
        return Person::orderBy('first_name')->paginate($perPage);
    }

    public function get($id) {
        return Person::find($id);
    }

    public function addFromInput($request) {
        $person = new Person;
        $person->first_name = $request->input('first-name');
        $person->save();
    }

    public function updateFromInput($id, $request) {
        
    }

    public function delete($id) {
        Person::find($id)->delete();
    }

}