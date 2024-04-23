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

    public function getValue($name) {
        return Setting::where('name', $name)->first()->value;
    }

    public function add($name, $value) {
        Setting::create(['name' => $name, 'value' => $value]);
    }

    public function updateFromInput($id, $formFields) {
        $setting = $this->get($id);
        if (!$setting)
            return;
        $setting->value = $formFields['value'];
        $setting->save();
    }
}