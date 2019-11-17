<?php

namespace App\Repositories\Interfaces;

interface IAnimalsRepository {

    public function all();
    public function allFilteredAndPaginated($request, $appendNonShelterAnimals, $perPage, $onlyNonShelter);
    public function addFromInput($request);
    public function updateFromInput($id, $request);
    public function get($id);
    public function delete($id);
}