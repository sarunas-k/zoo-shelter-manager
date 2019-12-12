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

    public function addFromInput($formFields) {
        $staff = new Staff;
        $staff->first_name = $formFields['first-name'];
        $staff->last_name = $formFields['last-name'];
        $staff->phone = $formFields['phone'];
        $staff->is_vet = $formFields['is-vet'] == 'on' ? '1' : '0';
        $staff->save();
    }

    public function updateFromInput($id, $formFields) {
        $staff = $this->get($id);
        if (isset($formFields['phone'])) {
            $staff->phone = $formFields['phone'];
        }
        if ($formFields['is_vet'] == 'true' || $formFields['is_vet'] == '1') {
            $staff->is_vet = '1';
        } else {
            $staff->is_vet = '0';
        }
        $staff->save();
    }

    public function delete($id) {
        $this->get($id)->delete();
    }

}