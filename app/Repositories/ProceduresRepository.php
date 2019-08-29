<?php

namespace App\Repositories;

use App\Animal;
use App\Procedure;
use App\Repositories\Interfaces\IProceduresRepository;

class ProceduresRepository implements IProceduresRepository {

    public function all() {
        return Procedure::all();
    }

    public function allPaginated($perPage = 10) {
        return Procedure::latest()->paginate($perPage);
    }

    public function get($id) {
        return Procedure::find($id);
    }

    public function getByVet($vetId) {
        return Procedure::where('vet_id', $vetId)->get();
    }

    public function addFromInput($request) {
        $animal = Animal::find($request->input('animal'));

        if ($animal !== null) {
            $procedure = new Procedure;
            $procedure->date = $request->input('procedure-date');
            $procedure->notes = $request->input('notes');
            $procedure->animal_id = $request->input('animal');
            $procedure->procedure_type_id = $request->input('procedure-type');
            $procedure->vet_id = $request->input('vet');
            $procedure->save();
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $this->get($id)->delete();
    }
}