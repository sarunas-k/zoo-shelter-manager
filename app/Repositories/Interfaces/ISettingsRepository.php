<?php

namespace App\Repositories\Interfaces;

interface ISettingsRepository {
    public function all();
    public function get($id);
    public function getByName($name);
    public function add($name, $value);
    public function updateFromInput($id, $formFields);
}