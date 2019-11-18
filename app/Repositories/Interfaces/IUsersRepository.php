<?php

namespace App\Repositories\Interfaces;

interface IUsersRepository {

    public function all();
    public function get($id);
    public function addFromInput($formFields);
    public function updateFromInput($id, $formFields);
    public function delete($id);
}