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

    public function addFromInput($formFields) {
        Person::create([
            'first_name' => $formFields['first-name'],
            'last_name' => $formFields['last-name'],
            'date_of_birth' => $formFields['date-of-birth'],
            'phone_first' => $formFields['phone-primary'],
            'phone_second' => $formFields['phone-secondary'],
            'address' => $formFields['address']
        ]);
    }

    public function updateFromInput($id, $formFields) {
        $person = $this->get($id);
        if (!$person)
            return;
        
        $person->update([
            'first_name' => $formFields['first-name'],
            'last_name' => $formFields['last-name'],
            'date_of_birth' => $formFields['date-of-birth'],
            'phone_first' => $formFields['phone-primary'],
            'phone_second' => $formFields['phone-secondary'],
            'address' => $formFields['address']
        ]);
    }

    public function delete($id) {
        Person::find($id)->delete();
    }

}