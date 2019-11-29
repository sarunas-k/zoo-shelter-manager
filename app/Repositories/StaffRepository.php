<?php

namespace App\Repositories;

use App\Staff;
use App\Repositories\Interfaces\IStaffRepository;

class StaffRepository implements IStaffRepository {

    public function all() {
        return Staff::all();
    }

    public function allVets() {
        return Staff::where('is_vet', '1')->get();
    }

    public function allPaginated($perPage = 10) {
        return Staff::paginate($perPage);
    }

    public function get($id) {
        return Staff::find($id);
    }

    public function addFromInput($request) {
        $staff = new Staff;
        $staff->first_name = $formFields('first-name');
        $staff->last_name = $formFields('last-name');
        $staff->phone = $formFields('phone');
        $staff->is_vet = $formFields('is-vet');
        $staff->save();
    }

    public function updateFromInput($id, $request) {
        
    }

    public function delete($id) {
        $this->get($id)->delete();
    }

}