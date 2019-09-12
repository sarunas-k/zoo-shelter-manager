<?php

namespace App\Repositories;

use App\LivingArea;
use App\Repositories\Interfaces\ILivingAreasRepository;

class LivingAreasRepository implements ILivingAreasRepository {

    public function all() {
        return LivingArea::all();
    }

    public function allPaginated($perPage = 10) {
        return LivingArea::paginate($perPage);
    }

    public function get($id) {
        return LivingArea::find($id);
    }

    public function addFromInput($request) {
        $livingArea = new LivingArea;
        $livingArea->name = $request->input('area-name');
        $livingArea->save();
    }

    public function updateFromInput($id, $formFields) {
        $livingArea = $this->get($id);
        $livingArea->name = $formFields['area-name'];
        $livingArea->save();
    }

    public function delete($id) {
        $this->get($id)->delete();
    }

}