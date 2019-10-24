<?php

namespace App\Repositories;

use App\Species;
use App\Repositories\Interfaces\ISpeciesRepository;

class SpeciesRepository implements ISpeciesRepository {

    public function all() {
        return Species::all();
    }

    public function allWithBreeds() {
        return Species::with(['breeds'])->get();
    }

    public function getSpeciesNames() {
        return Species::all()->pluck('name')->toArray();
    }

    public function allPaginated($perPage = 10) {
        return Species::paginate($perPage);
    }

    public function get($id) {
        return Species::find($id);
    }

    public function addFromInput($request) {
        $species = new Species;
        $species->name = $request->input('name');
        $species->save();
    }

    public function updateFromInput($id, $request) {
        $species = $this->get($id);
        $species->name = $request->input('name');
        $species->save();
    }

    public function delete($id) {
        $this->get($id)->delete();
    }

}