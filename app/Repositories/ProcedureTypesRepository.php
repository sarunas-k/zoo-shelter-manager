<?php

namespace App\Repositories;

use App\ProcedureType;
use App\Repositories\Interfaces\IProcedureTypesRepository;

class ProcedureTypesRepository implements IProcedureTypesRepository {

    public function all() {
        return ProcedureType::all();
    }

    public function allPaginated($perPage = 10) {
        return ProcedureType::paginate($perPage);
    }

    public function get($id) {
        return ProcedureType::find($id);
    }

    public function addFromInput($request) {
        $type = new ProcedureType;
        $type->name = $request->input('name');
        $type->save();
    }

    public function updateFromInput($id, $request) {
        $type = $this->get($id);
        $type->name = $request->input('name');
        $type->save();
    }

    public function delete($id) {
        $this->get($id)->delete();
    }

}