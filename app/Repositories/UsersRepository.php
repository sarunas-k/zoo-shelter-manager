<?php

namespace App\Repositories;

use App\User;
use App\Repositories\Interfaces\IUsersRepository;

class UsersRepository implements IUsersRepository {

    public function all() {
        return User::all();
    }

    public function get($id) {
        return User::find($id);
    }
    
    public function updateFromInput($id, $formFields) {
        $user = $this->get($id);
        $user->is_admin = $formFields['is_admin'] === 'true' ? 1 : 0;
        $user->save();
    }

    public function delete($id) {
        $this->get($id)->delete();
    }
}