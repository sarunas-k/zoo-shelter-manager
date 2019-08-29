<?php

namespace App\Repositories\Interfaces;

interface ISpeciesRepository {

    public function all();
    public function allPaginated($perPage);
    public function addFromInput($request);
    public function updateFromInput($id, $request);
    public function get($id);
    public function delete($id);
}