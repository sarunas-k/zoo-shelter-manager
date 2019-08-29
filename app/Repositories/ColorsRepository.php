<?php

namespace App\Repositories;

use App\Color;
use App\Repositories\Interfaces\IColorsRepository;

class ColorsRepository implements IColorsRepository {

    public function all() {
        return Color::all();
    }

    public function allPaginated($perPage = 10) {
        return Color::paginate($perPage);
    }

    public function get($id) {
        return Color::find($id);
    }

    public function addFromInput($request) {
        $color = new Color;
        $color->name = $request->input('name');
        $color->save();
    }

    public function updateFromInput($id, $request) {
        $color = $this->get($id);
        $color->name = $request->input('name');
        $color->save();
    }

    public function delete($id) {
        $this->get($id)->delete();
    }

}