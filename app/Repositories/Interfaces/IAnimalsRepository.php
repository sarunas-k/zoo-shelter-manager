<?php

namespace App\Repositories\Interfaces;

interface IAnimalsRepository {

    public function all();
    public function allFilteredAndPaginated($request, $perPage);
    public function addFromInput($request);
    public function updateFromInput($id, $request);
    public function get($id);
    public function delete($id);
}