<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IIntakeTypesRepository;
use App\IntakeType;

class IntakeTypesRepository implements IIntakeTypesRepository {

    public function all() {
        return IntakeType::all();
    }

}