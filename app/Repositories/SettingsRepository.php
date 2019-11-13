<?php

namespace App\Repositories;

use App\Setting;
use App\Repositories\Interfaces\ISettingsRepository;

class SettingsRepository implements ISettingsRepository {

    public function all() {
        return Setting::all();
    }

    public function get($id) {
        return Setting::find($id);
    } 

    public function getByName($name) {
        return Setting::where('name', $name)->get();
    }

    public function add($name, $value) {
        Setting::create(['name' => $name, 'value' => $value]);
    }

    public function update($name, $value) {
        $setting = Setting::where('name', $name);
        if (!$setting)
            return;
        
        $setting->update('value', $value);
    }
}