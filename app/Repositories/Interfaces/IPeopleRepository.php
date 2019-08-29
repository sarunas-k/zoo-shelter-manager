<?php

namespace App\Repositories\Interfaces;

interface IPeopleRepository {

    public function all();
    public function allPaginated($perPage);
    public function addFromInput($request);
    public function updateFromInput($id, $request);
    public function get($id);
    public function delete($id);
}